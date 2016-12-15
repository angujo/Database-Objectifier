<?php

namespace pdobuilder\clause;
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 05-Dec-16
 * Time: 7:36 PM
 */
class QueryBuilder
{
    public static $WHERE          = [];
    public static $SELECT         = [];
    public static $HAVING         = [];
    public static $BETWEEN        = [];
    public static $LIMIT          = [NULL, NULL];
    public static $ORDER_BY       = [];
    public static $GROUP_BY       = [];
    public static $PRIMARY_TABLES = [];
    
    protected $parameters = [];
    protected $table;
    private   $comparison = ['=', '>', '<', '>=', '<=', '<>', '!=', '<=>'];
    
    public function table($tableName, $alias = NULL)
    {
        if (is_array($tableName)) {
            foreach ($tableName as $table => $alias) {
                if (is_array($alias) || (!is_string($table) && (!is_string($alias) || !trim($alias)))) continue;
                $this->table($table, $alias);
            }
            return;
        }
        if (!is_string($tableName)) return;
        self::$PRIMARY_TABLES[] = $this->esc($tableName . ' ' . $alias);
    }
    
    
    protected function arrayBind($values)
    {
        $ps = [];
        foreach ($values as $value) {
            $ps[] = $this->valueBind($value);
        }
        return $ps;
    }
    
    protected function valueBind($value)
    {
        $this->parameters[$p = $this->paramBinder()] = $value;
        return $p;
    }
    
    private function paramBinder()
    {
        $str  = ':';
        $alph = range('a', 'z');
        $l    = rand(3, 8);
        for ($i = 0; $i < $l; $i++) {
            $d = rand(1, 2);
            $str .= $alph[($d == 1 ? rand(0, 9) : rand(10, 25))];
        }
        if (isset($this->parameters[$str])) return $this->paramBinder();
        return $str;
    }
    
    protected function esc($s, $pos = 0)
    {
        $s  = trim($s);
        $ph = [',' => '{com}', ' ' => '{spa}', '.' => '{dot}'];
        if ($this->isSQL($s) || 1 == preg_match('/((^(`)(.+?)(`)$)|(^(\'|\")(.+?)(\'|\")$)|(\((.+?)?(\))$)|(^([\d]+)(\.([\d]+))?$))/i', $s) || '*' == $s) {
            foreach ($ph as $key => $val) {
                $s = str_ireplace($val, $key, $s);
            }
            return $s;
        }
        $skips = [',', ' ', '.'];
        if (!isset($skips[$pos])) {
            $pre  = ('(' == substr($s, 0, 1) ? '(' : '');
            $suff = (')' == substr($s, -1, 1) ? ')' : '');
            $s    = trim($s, "\n\t )(");
            $s    = $this->isSQL($s) || in_array($s, $this->comparison) ? $s : '`' . $s . '`';
            return $pre . $s . $suff;
        }
        $followed = [' ', '', ''];
        $s        = preg_replace_callback('/(\'|\")(.+?)(\'|\")/i', function ($matches) use ($ph) {
            $pat = $matches[0];
            foreach ($ph as $ch => $_ph) {
                $pat = str_ireplace($ch, $_ph, $pat);
            }
            return $pat;
        }, $s);
        $par      = explode($skips[$pos], $s);
        $vls      = [];
        foreach ($par as $p) {
            $vls[] = $this->esc($p, ($pos + 1));
        }
        return implode($skips[$pos] . $followed[$pos], $vls);
    }
    
    private function isSQL($entry)
    {
        $sqls = ['ACCESSIBLE', 'ADD', 'ALL', 'ALTER', 'ANALYZE', 'AND', 'AS', 'ASC', 'ASENSITIVE', 'BEFORE', 'BETWEEN', 'BIGINT', 'BINARY', 'BLOB', 'BOTH', 'BY', 'CALL', 'CASCADE', 'CASE', 'CHANGE',
                 'CHAR', 'CHARACTER', 'CHECK', 'COLLATE', 'COLUMN', 'CONDITION', 'CONSTRAINT', 'CONTINUE', 'CONVERT', 'CREATE', 'CROSS', 'CURRENT_DATE', 'CURRENT_TIME', 'CURRENT_TIMESTAMP',
                 'CURRENT_USER', 'CURSOR', 'DATABASE', 'DATABASES', 'DAY_HOUR', 'DAY_MICROSECOND', 'DAY_MINUTE', 'DAY_SECOND', 'DEC', 'DECIMAL', 'DECLARE', 'DEFAULT', 'DELAYED', 'DELETE', 'DESC',
                 'DESCRIBE', 'DETERMINISTIC', 'DISTINCT', 'DISTINCTROW', 'DIV', 'DOUBLE', 'DROP', 'DUAL', 'EACH', 'ELSE', 'ELSEIF', 'ENCLOSED', 'ESCAPED', 'EXISTS', 'EXIT', 'EXPLAIN', 'FALSE',
                 'FETCH', 'FLOAT', 'FLOAT4', 'FLOAT8', 'FOR', 'FORCE', 'FOREIGN', 'FROM', 'FULLTEXT', 'GET', 'GRANT', 'GROUP', 'HAVING', 'HIGH_PRIORITY', 'HOUR_MICROSECOND', 'HOUR_MINUTE',
                 'HOUR_SECOND', 'IF', 'IGNORE', 'IN', 'INDEX', 'INFILE', 'INNER', 'INOUT', 'INSENSITIVE', 'INSERT', 'INT', 'INT1', 'INT2', 'INT3', 'INT4', 'INT8', 'INTEGER', 'INTERVAL', 'INTO',
                 'IO_AFTER_GTIDS', 'IO_BEFORE_GTIDS', 'IS', 'ITERATE', 'JOIN', 'KEY', 'KEYS', 'KILL', 'LEADING', 'LEAVE', 'LEFT', 'LIKE', 'LIMIT', 'LINEAR', 'LINES', 'LOAD', 'LOCALTIME',
                 'LOCALTIMESTAMP', 'LOCK', 'LONG', 'LONGBLOB', 'LONGTEXT', 'LOOP', 'LOW_PRIORITY', 'MASTER_BIND', 'MASTER_SSL_VERIFY_SERVER_CERT', 'MATCH', 'MAXVALUE', 'MEDIUMBLOB', 'MEDIUMINT',
                 'MEDIUMTEXT', 'MIDDLEINT', 'MINUTE_MICROSECOND', 'MINUTE_SECOND', 'MOD', 'MODIFIES', 'NATURAL', 'NOT', 'NO_WRITE_TO_BINLOG', 'NULL', 'NUMERIC', 'ON', 'OPTIMIZE', 'OPTION',
                 'OPTIONALLY', 'OR', 'ORDER', 'OUT', 'OUTER', 'OUTFILE', 'PARTITION', 'PRECISION', 'PRIMARY', 'PROCEDURE', 'PURGE', 'RANGE', 'READ', 'READS', 'READ_WRITE', 'REAL', 'REFERENCES',
                 'REGEXP', 'RELEASE', 'RENAME', 'REPEAT', 'REPLACE', 'REQUIRE', 'RESIGNAL', 'RESTRICT', 'RETURN', 'REVOKE', 'RIGHT', 'RLIKE', 'SCHEMA', 'SCHEMAS', 'SECOND_MICROSECOND', 'SELECT',
                 'SENSITIVE', 'SEPARATOR', 'SET', 'SHOW', 'SIGNAL', 'SMALLINT', 'SPATIAL', 'SPECIFIC', 'SQL', 'SQLEXCEPTION', 'SQLSTATE', 'SQLWARNING', 'SQL_BIG_RESULT', 'SQL_CALC_FOUND_ROWS',
                 'SQL_SMALL_RESULT', 'SSL', 'STARTING', 'STRAIGHT_JOIN', 'TABLE', 'TERMINATED', 'THEN', 'TINYBLOB', 'TINYINT', 'TINYTEXT', 'TO', 'TRAILING', 'TRIGGER', 'TRUE', 'UNDO', 'UNION',
                 'UNIQUE', 'UNLOCK', 'UNSIGNED', 'UPDATE', 'USAGE', 'USE', 'USING', 'UTC_DATE', 'UTC_TIME', 'UTC_TIMESTAMP', 'VALUES', 'VARBINARY', 'VARCHAR', 'VARCHARACTER', 'VARYING', 'WHEN',
                 'WHERE', 'WHILE', 'WITH', 'WRITE', 'XOR', 'YEAR_MONTH', 'ZEROFILL'];
        return in_array(strtoupper($entry), $sqls);
    }
}
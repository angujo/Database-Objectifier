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
    /*protected $WHERE          = [];
    protected $SELECT         = [];
    protected $HAVING         = [];
    protected $BETWEEN        = [];
    protected $LIMIT          = [NULL, NULL];
    protected $ORDER_BY       = [];
    protected $GROUP_BY       = [];*/
    
    const COMPILE_FLAT    = 0;
    const COMPILE_EQUATE  = 1;
    const COMPILE_COLUMNS = 2;
    const COMPILE_VALUES  = 3;
    const COMPILE_BOTH    = 4;
    
    public static $TABLE_REFERENCES = [];
    protected     $PRIMARY_TABLES   = [];
    
    public static $PARAMETERS = [];
    protected     $table;
    protected     $comparison = ['=', '>', '<', '>=', '<=', '<>', '!=', '<=>', 'LIKE', 'NOT LIKE'];
    
    public function getTables() { return $this->PRIMARY_TABLES; }
    
    public function table($tableName, $alias = NULL)
    {
        if (is_array($tableName)) {
            foreach ($tableName as $table => $alias) {
                if (is_array($alias) || is_array($table) || (!is_string($table) && !is_string($alias))) continue;
                if (!is_string($table)) {
                    $table = $alias;
                    $alias = NULL;
                }
                $this->table($table, $alias);
            }
            return;
        } else {
            $ts = array_map('trim', array_filter(explode(',', $tableName), 'trim'));
            if (!count($ts)) return;
            if (1 < count($ts)) {
                foreach ($ts as $t) {
                    $this->table($t);
                }
                return;
            } else {
                $tableName = $ts[0];
            }
        }
        if (!is_string($tableName) && !is_string($alias)) return;
        if (NULL === $alias || !is_string($alias) || !trim($alias)) {
            $ts = array_map('trim', array_filter(explode(' ', $tableName), 'trim'));
            if (!count($ts)) return;
            if (1 < count($ts)) {
                $this->table($ts[0], $ts[1]);
                return;
            } else {
                $tableName = $ts[0];
            }
            $alias = '';
        }
        if ((!is_string($tableName) || is_numeric($tableName)) && (!is_numeric($alias) && is_string($alias) && trim($alias))) {
            $tableName = $alias;
            $alias     = '';
        } elseif ((!is_string($tableName) || is_numeric($tableName)) && (!is_string($alias) || is_numeric($alias))) return;
        $this->PRIMARY_TABLES[] = $this->esc(trim($tableName . ' ' . $alias));
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
        if (FALSE !== ($p = array_search($value, self::$PARAMETERS))) return $p;
        self::$PARAMETERS[$p = $this->paramBinder()] = $value;
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
        if (isset(self::$PARAMETERS[$str])) return $this->paramBinder();
        return $str;
    }
    
    protected function validVar($var)
    {
        return is_string($var) || is_numeric($var);
    }
    
    public static function escape($s) { return (new self())->esc($s); }
    
    protected function esc($s)
    {
        $s = $this->removeStringCaptures(trim($s));
        if ($this->returnAsIs($s)) return $s;
        if ('(' == substr($s, 0, 1) && ')' == substr($s, -1, 1)) {
            return '(' . $this->esc(trim($s, '() ')) . ')';
        }
        return $this->separatorBreakDown($s);
    }
    
    private function separatorBreakDown($s, $pos = 0)
    {
        if (0 == preg_match('/(\,|\s|\.|\(|\))/', $s)) return $this->doEscape($s);
        $separators = [',', ' ', '.', '(', ')'];
        if (!isset($separators[$pos])) {
            return $this->esc($s);
        }
        return implode($separators[$pos], array_map(function ($it) use ($pos) { return $this->separatorBreakDown($it, ($pos + 1)); }, explode($separators[$pos], $s)));
    }
    
    private function doEscape($s)
    {
        $s = trim($s, ' `');
        return ($this->isSQL($s) || $this->isSQLFunction($s) || is_numeric($s) || 1 == preg_match('/^(\:)([a-z]+)$/', $s) || in_array($s, $this->comparison) || !trim($s) || '*' == $s) ? $s : "`{$s}`";
    }
    
    private function removeStringCaptures($s)
    {
        return preg_replace_callback('/(\'(.+?)\')|("(.+?)")/', function ($matches) {
            $pos = count($matches) - 1;
            return $this->valueBind($matches[$pos]);
        }, $s);
    }
    
    private function returnAsIs($s)
    {
        return $this->isSQL($s) || 1 == preg_match('/((^(\:)([a-zA-Z]+)$)|(^(`)(.+?)(`)$)|(^(\'|\")(.+?)(\'|\")$)|(\((.+?)?(\))$)|(^([\d]+)(\.([\d]+))?$))/i', $s) || '*' == $s;
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
    
    private function isSQLFunction($entry)
    {
        $functions = ['ABS', 'ACOS', 'ADDDATE', 'ADDTIME', 'ASCII', 'ASIN', 'ATAN', 'ATAN', 'AVG', 'BIN', 'BINARY', 'CASE', 'CAST', 'CEIL', 'CEILING', 'CHAR_LENGTH', 'CHARACTER_LENGTH', 'COALESCE',
                      'CONCAT', 'CONCAT_WS', 'CONNECTION_ID', 'CONV', 'CONVERT', 'COS', 'COT', 'COUNT', 'CURDATE', 'CURRENT_DATE', 'CURRENT_TIME', 'CURRENT_TIMESTAMP', 'CURRENT_USER', 'CURTIME',
                      'DATABASE', 'DATE', 'DATE_ADD', 'DATE_FORMAT', 'DATE_SUB', 'DATEDIFF', 'DAY', 'DAYNAME', 'DAYOFMONTH', 'DAYOFWEEK', 'DAYOFYEAR', 'DEGREES', 'DIV', 'ENCRYPT', 'EXP', 'EXTRACT'];
        return in_array(strtoupper($entry), $functions);
    }
    
    public function getParameters()
    {
        return self::$PARAMETERS;
    }
    
    protected function isAssociative(array $entries)
    {
        if (!count($entries)) return FALSE;
        if (array_keys($entries) == range(0, count($entries) - 1)) return FALSE;
        if (0 >= count(array_filter($entries, 'is_string'))) return FALSE;
        return TRUE;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 13/12/2016
 * Time: 05:01 PM
 */

namespace pdobuilder\clause;

use pdobuilder\QueryClauses;

/**
 * Class Having
 * @package pdobuilder\clause The Package Here
 *
 * @method static havingGreaterThan($column, $value = NULL, $escape = FALSE);
 * @method static havingLessThan($column, $value = NULL, $escape = FALSE);
 * @method static havingGreaterEqual($column, $value = NULL, $escape = FALSE);
 * @method static havingNotEqual($column, $value = NULL, $escape = FALSE);
 * @method static havingLessEqual($column, $value = NULL, $escape = FALSE);
 * @method static havingIn($column, array $value);
 * @method static having($column, $value, $escape = FALSE);
 * @method static havingNotIn($column, array $value);
 * @method static orHavingLessThan($column, $value = NULL, $escape = FALSE);
 * @method static orHavingGreaterEqual($column, $value = NULL, $escape = FALSE);
 * @method static orHavingNotEqual($column, $value = NULL, $escape = FALSE);
 * @method static orHavingLessEqual($column, $value = NULL, $escape = FALSE);
 * @method static orHavingIn($column, array $value);
 * @method static orHavingNotIn($column, array $value);
 */
class Having extends QueryClauses
{
    private static $having  = [];
    private static $keyWord = 'having';
    
    static function __callStatic($name, $arguments)
    {
        if (2 > count($arguments)) return new static();
        $column = @$arguments[0];
        $value  = @$arguments[1];
        $escape = TRUE === @$arguments[2] ?: FALSE;
        $name   = strtolower(trim($name));
        $gotIt  = FALSE;
        foreach (self::$connectors as $key => $connector) {
            foreach (self::$operators as $operator => $naming) {
                if ($name == $connector . self::$keyWord . $naming) {
                    //TODO Escape column first condition result
                    $column   = NULL === $value && FALSE === $escape ? $column : $column;
                    $operator = NULL === $value && TRUE == $escape ? 'IS' : (is_array($value) && !in_array($operator, ['in', 'not in']) ? 'IN' : $operator);
                    //TODO Escape value when escape is TRUE
                    $value          = $operator == 'IS' ? 'NULL' : (TRUE === $escape ? $value : $value);
                    self::$having[] = [$key, $column, $operator, $value];
                    $gotIt          = TRUE;
                    break 2;
                }
            }
        }
        if (!$gotIt) throw new \Exception("Invalid Having Function Called on class 'Having'. Function: " . $name);
        return new static();
    }
}
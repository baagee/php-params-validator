<?php
/**
 * Desc: URL验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class UrlRule
 * @package BaAGee\ParamsValidator\Rules
 */
class UrlRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
            return false;
        }
        return ["data" => $value];
    }
}

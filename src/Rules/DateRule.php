<?php
/**
 * Desc: 日期时间格式验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class DateRule
 * @package BaAGee\ParamsValidator\Rules
 */
class DateRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        if (date_create_from_format($this->params['format'], $value) === false) {
            return false;
        }
        return ["data" => $value];
    }
}

<?php
/**
 * Desc: 邮政编码验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class ZipRule
 * @package BaAGee\ParamsValidator\Rules
 */
class ZipRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        $res = preg_match("/^[1-9]\d{5}$/", $value);
        if ($res === false || $res === 0) {
            return false;
        }
        return ["data" => $value];
    }
}

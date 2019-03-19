<?php
/**
 * Desc: Json字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class JsonRule
 * @package BaAGee\ParamsValidator\Rules
 */
class JsonRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        $obj = json_decode($value, true);
        if ($obj === false || json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }
        if (isset($this->params['decode'])) {
            $value = $obj;
        }
        return ["data" => $value];
    }
}

<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class JsonRule extends RuleAbstract
{
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

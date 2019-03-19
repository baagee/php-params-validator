<?php
/**
 * Desc: 数字整型验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class IntegerRule
 * @package BaAGee\ParamsValidator\Rules
 */
class IntegerRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        if (!is_numeric($value)) {
            return false;
        }
        if (!isset($this->params['optional']) && !isset($this->params['required']) && empty($value)) {
            return ["data" => 0];
        }
        $value = intval($value);
        if (isset($this->params['min']) && $value < $this->params['min']) {
            return false;
        }
        if (isset($this->params['max']) && $value > $this->params['max']) {
            return false;
        }
        return ["data" => $value];
    }
}

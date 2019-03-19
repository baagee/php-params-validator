<?php
/**
 * Desc: 判断是否相等
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class EqualRule
 * @package BaAGee\ParamsValidator\Rules
 */
class EqualRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        if ($value !== $this->params['this']) {
            return false;
        }
        return ["data" => $value];
    }
}

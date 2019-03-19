<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class EqualRule extends RuleAbstract
{
    public function check($value)
    {
        if ($value !== $this->params['this']) {
            return false;
        }
        return ["data" => $value];
    }
}

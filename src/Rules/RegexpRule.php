<?php
/**
 * Desc: 自定义正则表达式验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class RegexpRule
 * @package BaAGee\ParamsValidator\Rules
 */
class RegexpRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        $res = preg_match($this->params['pattern'], $value);
        if ($res === false || $res === 0) {
            return false;
        }
        return ["data" => $value];
    }
}

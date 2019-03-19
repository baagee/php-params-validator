<?php
/**
 * Desc: 判断是否为字母、数字、下划线（_）、破折号（-）
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class AlphaDashRule
 * @package BaAGee\ParamsValidator\Rules
 */
class AlphaDashRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        $res = preg_match('/^([a-z0-9_-])+$/i', $value);
        if ($res === false || $res === 0) {
            return false;
        }
        $length = strlen($value);
        if (isset($this->params['min']) && $length < $this->params['min']) {
            return false;
        }
        if (isset($this->params['max']) && $length > $this->params['max']) {
            return false;
        }
        return ["data" => $value];
    }
}

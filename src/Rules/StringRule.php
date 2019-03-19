<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class StringRule
 * @package BaAGee\ParamsValidator\Rules
 */
class StringRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        $value = strval($value);
        // 使用mb_strlen
        $length = mb_strlen($value, 'utf-8');
        if (isset($this->params['min']) && $length < $this->params['min']) {
            return false;
        }
        if (isset($this->params['max']) && $length > $this->params['max']) {
            return false;
        }
        if (isset($this->param["notrim"])) {
            // 不经过trim过滤
            return array("data" => $value);
        }
        return ["data" => trim($value)];
    }
}

<?php
/**
 * Desc: 中文字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class ChineseRule
 * @package BaAGee\ParamsValidator\Rules
 */
class ChineseRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        if (strlen($value) === 0) {
            return false;
        }
        $res = preg_match("/^[\x7f-\xff]+$/", $value);
        if ($res === false || $res === 0) {
            return false;
        }
        $length = mb_strlen($value);
        if (isset($this->params['min']) && $length < $this->params['min']) {
            return false;
        }
        if (isset($this->params['max']) && $length > $this->params['max']) {
            return false;
        }
        return ['data' => $value];
    }
}

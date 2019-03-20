<?php
/**
 * Desc: 手机号验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class PhoneRule
 * @package BaAGee\ParamsValidator\Rules
 */
class PhoneRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     * @throws \Exception
     */
    public function check($value)
    {
        if (!isset($this->params['type'])) {
            throw new \Exception('电话号码类型不能为空');
        }
        $type  = $this->params['type'];
        $types = ['mobile', 'land', 'service'];
        if (!in_array($type, $types)) {
            throw new \Exception('电话号码类型只支持：' . implode(',', $types));
        }
        switch ($type) {
            case 'mobile':
                // 手机号
                $status = preg_match('/^1(3|4|5|6|7|8|9)[0-9]\d{8}$/', $value);
                if (false === $status || 0 === $status) {
                    return false;
                }
                break;
            case 'land':
                // 座机
                $status = preg_match('/^(0\d{2,3}-?)?\d{7,8}$/', $value);
                if (false === $status || 0 === $status) {
                    return false;
                }
                break;
            case 'service':
                // 服务热线
                $status = preg_match('/^[48]00-?\d{3}-?\d{4}$/', $value);
                if (false === $status || 0 === $status) {
                    return false;
                }
                break;
        }
        return ["data" => $value];
    }
}

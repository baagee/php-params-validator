<?php
/**
 * Desc: 参数异常
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午11:04
 */

namespace BaAGee\ParamsValidator\Base;

/**
 * Class ParamInvalid
 * @package BaAGee\ParamsValidator\Base
 */
final class ParamInvalid extends \InvalidArgumentException
{
    /**
     * @var string 验证规则名
     */
    protected $rule = '';
    /**
     * @var string 验证字段名
     */
    protected $field = '';
    /**
     * @var string 验证的值
     */
    protected $value = '';

    /**
     * ParamInvalid constructor.
     * @param string $message
     * @param string $rule
     * @param string $field
     * @param string $value
     */
    public function __construct(string $message, string $rule = '', string $field = '', $value = '')
    {
        parent::__construct($message);
        $this->rule  = $rule;
        $this->value = $value;
        $this->field = $field;
    }

    /**
     * 获取验证规则类名
     * @return string
     */
    public function getRule(): string
    {
        return $this->rule;
    }

    /**
     * 获取验证字段名字
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * 获取验证值
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}

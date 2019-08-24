<?php
/**
 * Desc: 抽象验证规则
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午5:01
 */

namespace BaAGee\ParamsValidator\Base;

/**
 * Class RuleAbstract
 * @package BaAGee\ParamsValidator\Base
 */
abstract class RuleAbstract
{
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param array $params
     * @return $this
     */
    final public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * RuleAbstract constructor.
     * @param array $params
     * @throws \Exception
     */
    public function __construct(array $params = [])
    {
        if (!empty($params)) {
            foreach ($params as $val) {
                $res = preg_match('/^(\w+)(\[(.*)\])?$/', $val, $matches);
                if ($res === false || $res === 0) {
                    throw new \Exception(sprintf('参数验证规则[%s]不合法', $val));
                }
                if (!isset($matches[3])) {
                    $matches[3] = "";
                }
                $this->params[$matches[1]] = $matches[3];
            }
        }
    }

    /**
     * 验证之前
     * @param $value
     * @return array|bool|null
     */
    public function beforeCheck($value)
    {
        if (is_null($value) && isset($this->params['default'])) {
            // 设置默认值
            $value = $this->params['default'];
        }
        if (is_null($value) && isset($this->params['optional'])) {
            // 如果是可选的但是值为空就跳过验证
            return null;
        }
        if (is_null($value) && isset($this->params['required'])) {
            // 如果值为空 但是是必须的就直接返回验证失败
            return false;
        }
        return ["data" => $value];
    }

    /**
     * @param $value
     * @return mixed
     */
    abstract public function check($value);
}
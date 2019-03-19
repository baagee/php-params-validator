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
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    /**
     * RuleAbstract constructor.
     * @param array $params
     * @throws \Exception
     */
    public function __construct(array $params = [])
    {
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

    /**
     * @param $value
     * @return array|bool|null
     */
    public function beforeCheck($value)
    {
        if (empty($value) && isset($this->params['default'])) {
            $value = $this->params['default'];
        }
        if (empty($value) && isset($this->params['optional'])) {
            return null;
        }
        if (empty($value) && isset($this->params['required'])) {
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
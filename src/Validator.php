<?php
/**
 * Desc: 参数验证器
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午4:52
 */

namespace BaAGee\ParamsValidator;

use BaAGee\ParamsValidator\Base\RuleAbstract;
use BaAGee\ParamsValidator\Base\ValidatorAbstract;

/**
 * Class Validator
 * @package BaAGee\ParamsValidator
 */
class Validator extends ValidatorAbstract
{
    /**
     * @param        $field
     * @param        $value
     * @param        $rule
     * @param string $errorMessage
     * @throws \Exception
     */
    public function addRule($field, $value, $rule, $errorMessage = '')
    {
        $ruleArray = array_filter(explode('|', $rule));
        $ruleClass = __NAMESPACE__ . '\\Rules\\' . ucfirst(array_shift($ruleArray)) . 'Rule';
        if (class_exists($ruleClass)) {
            if (is_subclass_of($ruleClass, RuleAbstract::class)) {
                $ruleObj       = new $ruleClass($ruleArray);
                $this->rules[] = [$field, $value, $ruleObj, $errorMessage];
            } else {
                throw new \Exception(sprintf('[%s]没有继承[%s]', $ruleClass, RuleAbstract::class));
            }
        } else {
            throw new \Exception(sprintf('[%s]验证规则类不存在', $ruleClass));
        }
    }

    /**
     * @return array
     */
    public function validate()
    {
        $arrRule     = $this->rules;
        $this->rules = [];
        $filterData  = [];
        foreach ($arrRule as $rule) {
            list($_key, $_var, $_validator, $_msg) = $rule;
            $_bVar = $_validator->beforeCheck($_var);
            if (null === $_bVar) {
                continue;
            }
            $_msg = !empty($_msg) ? $_msg : sprintf("参数[%s]验证失败", $_key);
            if (false === $_bVar) {
                throw new \InvalidArgumentException($_msg);
            }
            $_var = $_bVar['data'];
            $vRes = $_validator->check($_var);
            if (false === $vRes) {
                throw new \InvalidArgumentException($_msg);
            }
            $filterData[$_key] = $vRes['data'];
        }
        return $filterData;
    }
}

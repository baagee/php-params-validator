<?php
/**
 * Desc: 参数验证器
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午4:52
 */

namespace BaAGee\ParamsValidator;

use BaAGee\ParamsValidator\Base\ParamInvalid;
use BaAGee\ParamsValidator\Base\RuleAbstract;
use BaAGee\ParamsValidator\Base\ValidatorAbstract;

/**
 * Class Validator
 * @package BaAGee\ParamsValidator
 */
class Validator extends ValidatorAbstract
{
    /**
     * 添加字段验证规则
     * @param string $field 要验证的字段
     * @param mixed  $value 值
     * @param array  $rules 验证规则
     *                      [
     *                      ['string|min[6]','字符串长度最小6位'],
     *                      ['alphaNumber|max[12]','字母数字字符串最大12位'],
     *                      ]
     * @throws \Exception
     * @return $this
     */
    public function addRules(string $field, $value, array $rules)
    {
        $ruleObjArray = [];
        foreach ($rules as $rule) {
            if (!is_array($rule)) {
                throw new \Exception('参数验证规则格式错误');
            }
            $ruleString   = $rule[0];
            $errorMessage = (isset($rule[1]) && !empty($rule[1])) ? $rule[1] : self::getDefaultErrorMessage($field);
            $ruleArray    = array_filter(explode('|', $ruleString));
            $ruleClass    = __NAMESPACE__ . '\\Rules\\' . ucfirst(array_shift($ruleArray)) . 'Rule';
            if (class_exists($ruleClass)) {
                if (is_subclass_of($ruleClass, RuleAbstract::class)) {
                    $ruleObjArray[] = [new $ruleClass($ruleArray), $errorMessage];
                } else {
                    throw new \Exception(sprintf('[%s]没有继承[%s]', $ruleClass, RuleAbstract::class));
                }
            } else {
                throw new \Exception(sprintf('[%s]验证规则类不存在', $ruleClass));
            }
        }
        $this->rules[$field] = [$value, $ruleObjArray];
        return $this;
    }

    /**
     * 批量添加验证规则
     * @param array $data  要验证的数据数组
     * @param array $rules 对应的数据验证规则二维数组
     * @return $this
     * @throws \Exception
     */
    public function batchAddRules(array $data, array $rules)
    {
        foreach ($rules as $field => $rule) {
            // 单一规则验证
            $this->addRules($field, $data[$field], $rule);
        }
        return $this;
    }

    /**
     * 开始验证
     * @return array 返回验证后的字段
     */
    public function validate()
    {
        $arrRule     = $this->rules;
        $this->rules = [];
        $filterData  = [];
        foreach ($arrRule as $_key => $rule) {
            $_var        = $rule[0];
            $_validators = $rule[1];
            foreach ($_validators as $_validator) {
                list($validator, $errorMessage) = $_validator;
                $_var = $validator->beforeCheck($_var);
                if (null === $_var) {
                    continue;
                }
                if (false === $_var) {
                    throw new ParamInvalid($errorMessage);
                }
                $_var = $validator->check($_var['data']);
                if (false === $_var) {
                    throw new ParamInvalid($errorMessage);
                }
                $_var = $_var['data'];
            }
            $filterData[$_key] = $_var;
        }
        return $filterData;
    }

    /**
     * 使用自定义的验证规则验证
     * @param string $field        要验证的字段
     * @param mixed  $value        值
     * @param string $rule         验证规则
     * @param string $errorMessage 验证错误信息
     * @return $this
     * @throws \Exception
     */
    public function addMyRule(string $field, $value, string $rule, string $errorMessage = '')
    {
        $ruleArray   = array_filter(explode('|', $rule));
        $myRuleClass = array_shift($ruleArray);
        if (!class_exists($myRuleClass)) {
            throw new \Exception(sprintf('[%s]自定义验证规则不存在', $myRuleClass));
        }
        if (is_subclass_of($myRuleClass, RuleAbstract::class)) {
            if (empty($errorMessage)) {
                $errorMessage = self::getDefaultErrorMessage($field);
            }
            $ruleObjArray[] = [new $myRuleClass($ruleArray), $errorMessage];
        } else {
            throw new \Exception(sprintf('[%s]没有继承[%s]', $myRuleClass, RuleAbstract::class));
        }
        $this->rules[$field] = [$value, $ruleObjArray];
        return $this;
    }

    /**
     * 获取默认错误信息
     * @param $field
     * @return string
     */
    protected static function getDefaultErrorMessage($field)
    {
        return sprintf("参数[%s]验证失败", $field);
    }
}

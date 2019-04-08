<?php
/**
 * Desc:
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午11:38
 */

include_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class MyRule 自定义验证规则 验证是否为某个数的倍数
 */
class MyRule extends \BaAGee\ParamsValidator\Base\RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        $value = intval($value);
        if ($value % $this->params['mo'] !== 0) {
            return false;
        }
        return ['data' => $value];
    }
}

$validator = \BaAGee\ParamsValidator\Validator::getInstance();

try {
    // 注意自定义规则处理类的命名空间，要传完全限定名字
    $validator->addMyRule('num', 29, sprintf('%s|mo[5]', MyRule::class), 'num不是5的倍数');
    $res = $validator->validate();
    var_dump($res);
} catch (\BaAGee\ParamsValidator\Base\ParamInvalid $exception) {
    // 获取出错的参数信息 验证规则，参数名 ，参数值
    echo sprintf('rule: %s ; field: %s ; value: %s ;' . PHP_EOL, $exception->getRule(), $exception->getField(), $exception->getValue());
    die('Error:' . $exception);
}

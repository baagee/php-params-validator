<?php
/**
 * Desc: TEST
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午5:11
 */
include_once __DIR__ . '/../vendor/autoload.php';

$validator = new \BaAGee\ParamsValidator\Validator();

echo str_repeat('#单一验证', 20) . PHP_EOL;
try {
    $validator->addRules('order_id', '1234567890', [['number|min[10]|max[10]', '订单号不是10位数字']]);
    $res = $validator->validate();
} catch (\BaAGee\ParamsValidator\Base\ParamInvalid $e) {
    die('Error:' . $e);
}
var_dump($res);

echo str_repeat('#批量验证', 20) . PHP_EOL;

$data = [
    'name'        => 'lotly',
    'age'         => '',
    'sex'         => 1,
    'phone'       => 17878787870,
    'birthday'    => '2019-09-23',
    'weight'      => 50.4,
    'password'    => 'password098',
    'regexp'      => 'dsfa78sdgs-',
    'macAddress'  => '00-01-6C-06-A6-29',
    'IdCard'      => '41282319900909121X',
    'email'       => '32r2345234@qq.x',
    'zip'         => 240990,
    'homePage'    => 'http://sdfgs.com/asdgfsd?fds=43t&sfds=90',
    'ip'          => '234.32.32.90',
    'ext'         => '{"money":342.3}',
    'bankId'      => '621081257000009900',
    'telephone'   => '010-86551122',
    'chinese'     => '溜溜溜溜',
    'alphaDash'   => 'er2454_34t4-knj',
    'plateNo'     => '京Q9087P',
    'alphaNumber' => 'sdgs34t35ad',
    'alpha'       => 'asdgsege',
    'number'      => '234543456',
    'qq'          => '90876543212',
    'optional'    => '87uhu哈'
];

$rules = [
    'age'         => [
        ['integer|optional|default[20]', '年龄不合法1'],
        ['integer|required|min[18]|max[24]', '年龄不合法2']
    ],
    'qq'          => [
        ['number|required', 'QQ不是纯数字'],
        ['qq', '不是QQ号码']
    ],
    'name'        => [['string|default[eee]|min[2]|max[40]', '名字不合法']],
    'weight'      => [['float|min[40.0]|max[55.0]', '体重不合法']],
    'birthday'    => [['date|format[Y-m-d]', '出生日期不合法']],
    'sex'         => [['enum|allows[1,2]', '性别不合法']],
    'password'    => [['equal|this[password098]', '密码不正确']],
    'regexp'      => [['regexp|pattern[/[a-z0-9]+/]', 'regexp不合法']],
    'phone'       => [['phone', '手机号不合法']],
    'macAddress'  => [['mac', 'mac地址不合法']],
    'optional'    => [['string|optional|min[6]', 'optional最小6位']],
    'IdCard'      => [
        ['alphaNum|min[18]|max[18]', '身份证不是16位'],
        // ['IdCard', '身份证不合法'],
    ],
    'email'       => [['email', '邮箱不合法']],
    'zip'         => [['zip', '邮政编码不合法']],
    'homePage'    => [['url', '个人主页不合法']],
    'ip'          => [['ip', 'IP不合法']],
    'ext'         => [['json|decode', 'Ext Json不合法']],
    // 'bankId'      => [['BankId', '银行卡号不合法']],
    'telephone'   => [['telephone', '座机号码不合法']],
    'chinese'     => [['chinese|min[2]|max[4]', '不是纯中文或者长度不在2-4范围内']],
    'alphaDash'   => [['alphaDash', '不是字母数字—_-']],
    'plateNo'     => [['plateNo', '车牌号不合法']],
    'alphaNumber' => [['alphaNum', '不是字母数字组合']],
    'alpha'       => [['alpha', '不是纯字母']],
    'number'      => [['number', '不是纯数字']],
];
try {
    $data = $validator->batchAddRules($data, $rules)->validate();
    var_dump($data);
} catch (\BaAGee\ParamsValidator\Base\ParamInvalid $e) {
    die('Error:' . $e);
}

echo str_repeat('#使用单个验证规则', 8) . PHP_EOL;
// 使用单个验证规则
$stringRule = new \BaAGee\ParamsValidator\Rules\StringRule();
$res        = $stringRule->setParams(['min' => 6, 'max' => 12])->check('123jk45');
var_dump($res);
if ($res === false) {
    echo '验证失败' . PHP_EOL;
}
// 或者
$res = (new \BaAGee\ParamsValidator\Rules\StringRule(['min' => 6, 'max' => 12]))->check('123jk45');
var_dump($res);
if ($res === false) {
    echo '验证失败' . PHP_EOL;
}

echo str_repeat('#', 100) . PHP_EOL;
<?php
/**
 * Desc: 银行卡号码验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class BankIdRule
 * @package BaAGee\ParamsValidator\Rules
 */
class BankIdRule extends RuleAbstract
{
    /**
     * 判断是否是真确的银行卡号
     * -------Luhn算法-------
     * 将未带校验位的 15 位卡号从右依次编号 1 到 15，位于奇数位号上的数字乘以 2
     * 将奇位乘积的个十位全部相加，再加上所有偶数位上的数字
     * 将加法和加上校验位能被 10 整除。
     * ---------------------
     * @param string $value 银行卡号
     * @return bool|array
     */
    public function check($value)
    {
        $arrNo = str_split($value);
        $lastN = $arrNo[count($arrNo) - 1];
        krsort($arrNo);
        $i     = 1;
        $total = 0;
        foreach ($arrNo as $n) {
            if ($i % 2 == 0) {
                $ix = $n * 2;
                if ($ix >= 10) {
                    $nx    = 1 + ($ix % 10);
                    $total += $nx;
                } else {
                    $total += $ix;
                }
            } else {
                $total += $n;
            }
            $i++;
        }
        $total -= $lastN;
        $total *= 9;
        if ($lastN == ($total % 10)) {
            return ["data" => $value];
        } else {
            return false;
        }
    }
}

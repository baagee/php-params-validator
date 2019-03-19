<?php
/**
 * Desc: 身份证验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class IdCardRule
 * @package BaAGee\ParamsValidator\Rules
 */
class IdCardRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        $vCity = [
            '11', '12', '13', '14', '15', '21', '22', '23', '31', '32', '33', '34',
            '35', '36', '37', '41', '42', '43', '44', '45', '46', '50', '51', '52',
            '53', '54', '61', '62', '63', '64', '65', '71', '81', '82', '91'
        ];
        $res   = preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $value);
        if ($res === false || $res === 0) {
            return false;
        }
        if (!in_array(substr($value, 0, 2), $vCity)) {
            return false;
        }
        $value   = preg_replace('/[xX]$/i', 'a', $value);
        $vLength = strlen($value);
        if ($vLength == 18) {
            $vBirthday = substr($value, 6, 4) . '-' . substr($value, 10, 2) . '-' . substr($value, 12, 2);
        } else {
            $vBirthday = '19' . substr($value, 6, 2) . '-' . substr($value, 8, 2) . '-' . substr($value, 10, 2);
        }
        if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) {
            return false;
        }
        if ($vLength == 18) {
            $vSum = 0;
            for ($i = 17; $i >= 0; $i--) {
                $vSubStr = substr($value, 17 - $i, 1);
                $vSum    += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr, 11));
            }
            if ($vSum % 11 != 1) {
                return false;
            }
        }
        return ["data" => $value];
    }
}

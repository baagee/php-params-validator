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
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}

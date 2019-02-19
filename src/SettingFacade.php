<?php
/**
 * Created by PhpStorm.
 * User: zhanglingyu
 * Date: 2019-02-19
 * Time: 12:43
 */

namespace ArcherZdip\Setting;


class SettingFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'setting';
    }
}
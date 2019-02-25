<?php
/**
 * Created by PhpStorm.
 * User: zhanglingyu
 * Date: 2019-02-19
 * Time: 12:43
 */

if (!function_exists('setting')) {
    /**
     * Get setting value or object.
     *
     * @param null $key
     * @param null $default
     * @return \Illuminate\Foundation\Application|mixed
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    function setting($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('setting');
        }
        return app('setting')->get($key, $default);
    }
}

if (!function_exists('setting_set')) {
    /**
     * Set setting value.
     *
     * @param $key
     * @param $valve
     * @param $type
     * @param $description
     * @return mixed
     */
    function setting_set(string $key, $valve, $type = null, $description = null)
    {
        return app('setting')->set($key, $valve, $type, $description);
    }
}

if (!function_exists('setting_exists')) {
    /**
     * Check the specified setting exits.
     *
     * @param  string $key
     * @return mixed
     */
    function setting_exists(string $key)
    {
        return app('setting')->exists($key);
    }
}

if (!function_exists('setting_remove')) {
    /**
     * Remove the setting value.
     *
     * @param $key
     * @return mixed
     */
    function setting_remove(string $key)
    {
        return app('setting')->remove($key);
    }
}
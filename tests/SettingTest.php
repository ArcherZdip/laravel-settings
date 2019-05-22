<?php
/**
 * Created by PhpStorm.
 * User: zhanglingyu
 * Date: 2019-02-19
 * Time: 13:43
 */

namespace ArcherZdip\Setting\Test;

use Tests\TestCase;
use ArcherZdip\Setting\Setting;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SettingTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     *
     */
    public function test_setting()
    {
        $this->assertInstanceOf(Setting::class, setting());
    }

    /**
     * @test
     *
     */
    public function test_set()
    {
        setting_set('key', 'value');

        $this->assertDatabaseHas('settings', ['key' => 'key', 'value' => 'value']);
    }

    /**
     * @test
     *
     */
    public function test_set_array()
    {
        setting_set('foo', [
            'name' => 'holle world'
        ], 'array');

        $this->assertEquals('holle world', setting('foo')['name']);
    }

    /**
     * @test
     *
     */
    public function test_get()
    {
        setting()->set('foo', 'holle world');

        $this->assertEquals('holle world', setting('foo'));
    }

    /**
     * @test
     *
     */
    public function test_get_default()
    {
        $this->assertEquals('holle world', setting('foo', 'holle world'));
    }

    /**
     * @test
     *
     */
    public function test_remove()
    {
        setting()->set('foo', 'holle world');
        $this->assertDatabaseHas('settings', ['key' => 'foo', 'value' => 'holle world']);

        setting_remove('foo');
        $this->assertDatabaseMissing('settings', ['key' => 'foo', 'value' => 'bar']);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: zhanglingyu
 * Date: 2019-02-19
 * Time: 12:43
 */

namespace ArcherZdip\Setting;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'description', 'type', 'value'
    ];

    protected $attributes = [
        'type' => 'string',
        'description' => '',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Determine if the given option value exists.
     *
     * @param  string $key
     * @return bool
     */
    public function exists($key)
    {
        return self::where('key', $key)->exists();
    }

    /**
     * Get the setting value.
     *
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $raw = $this->getRaw($key);
        return $raw ? $raw->value : value($default);
    }

    /**
     * Set a given setting value.
     *
     * @param string $key
     * @param $value
     * @param null $type
     * @param null $description
     * @return bool
     */
    public function set(string $key, $value, $type = null, $description = null)
    {
        $setting = self::where('key', $key)->first() ?: new static;
        $setting->key = $key;
        $setting->type = $type ?: $setting->type;
        $setting->value = $value;
        $setting->description = $description ?: $setting->description;

        return $setting->save() ? $value : false;
    }

    /**
     * Remove/delete the specified setting value.
     *
     * @param  string  $key
     * @return bool
     */
    public function remove($key)
    {
        return (bool) self::where('key', $key)->delete();
    }

    /**
     * $key setter
     *
     * @param string $value
     * @return Setting
     */
    public function setKeyAttribute(string $value)
    {
        $this->attributes['key'] = strtolower($value);

        return $this;
    }

    /**
     * $type setter
     *
     * @param string $value
     * @return Setting
     */
    public function setTypeAttribute(string $value)
    {
        $this->attributes['type'] = strtolower($value);

        return $this;
    }

    /**
     * $value setter
     *
     * @param $value
     * @return Setting
     */
    public function setValueAttribute($value)
    {
        if (!is_null($value)) {
            switch ($this->type) {
                case 'int':
                case 'integer':
                    $value = (int)$value;
                    break;
                case 'real':
                case 'float':
                case 'double':
                    $value = (float)$value;
                    break;
                case 'string':
                    $value = (string)$value;
                    break;
                case 'array':
                case 'json':
                case 'object':
                case 'collection':
                    $value = $this->castAttributeAsJson('value', $value);
                    break;
                case 'date':
                case 'datetime':
                    $value = $this->fromDateTime($value);
                    break;
            }
        }

        $this->attributes['value'] = $value;

        return $this;
    }

    /**
     * $value getter
     *
     * @param $value
     * @return mixed
     */
    public function getValueAttribute($value)
    {
        if (is_null($value)) {
            return $value;
        }

        switch ($this->type) {
            case 'int':
            case 'integer':
                return (int)$value;
            case 'real':
            case 'float':
            case 'double':
                return (float)$value;
            case 'string':
                return (string)$value;
            case 'bool':
            case 'boolean':
                return (bool)$value;
            case 'object':
                return $this->fromJson($value, true);
            case 'array':
            case 'json':
                return $this->fromJson($value);
            case 'collection':
                return new Collection($this->fromJson($value));
            case 'date':
                return $this->asDate($value);
            case 'datetime':
                return $this->asDateTime($value);
            case 'timestamp':
                return $this->asTimestamp($value);
            default:
                return $value;
        }
    }

    /**
     * @param string $key
     * @return |null
     */
    public function getRaw(string $key)
    {
        if ($setting = self::where('key', $key)->first()) {
            return $setting;
        }
        return null;
    }
}
<?php

namespace app\helpers;

class ArrayHelper
{
    /**
     * @param string $key
     * @param array|object $data
     * @param null $default
     * @return mixed|null
     */
    public static function getValue($key, $data, $default = null)
    {
        if (is_array($data)) {
            return self::getValueFromArray($key, $data, $default);
        }
        if (is_object($data)) {
            return self::getValueFromObject($key, $data, $default);
        }
        return $default;
    }

    /**
     * @param string $key
     * @param array $data
     * @param null $default
     * @return mixed|null
     */
    public static function getValueFromArray($key, $data, $default = null)
    {
        if (!is_array($data)) {
            return $default;
        }
        return array_key_exists($key, $data)
            ? $data[$key]
            : $default;
    }

    /**
     * @param string $key
     * @param object $data
     * @param null $default
     * @return mixed|null
     */
    public static function getValueFromObject($key, $data, $default = null)
    {
        if (!is_object($data)) {
            return $default;
        }
        return property_exists($data, $key)
            ? $data->$key
            : $default;
    }
}

<?php

if (function_exists('config') == false) {

    function config($name, $value = null ) {
        if ($value === null) {
            return Wudimei\StaticProxies\Config::get($name);
        } else {
            return Wudimei\StaticProxies\Config::set($name, $value);
        }
    }

}

if (function_exists('get') == false) {

    function get($name, $default = '') {
        return Wudimei\StaticProxies\Request::get($name, $default);
    }

}

if (function_exists('post') == false) {

    function post($name, $default = '') {
        return Wudimei\StaticProxies\Request::post($name, $default);
    }

}

if (function_exists('getInt') == false) {

    function getInt($name, $default = 0) {
        return Wudimei\StaticProxies\Request::getInt($name, $default);
    }

}


if (function_exists('getFloat') == false) {

    function getFloat($name, $default = 0) {
        return Wudimei\StaticProxies\Request::getFloat($name, $default);
    }

}

if (function_exists('isPost') == false) {

    function isPost() {
        return Wudimei\StaticProxies\Request::isPost();
    }

}

if (function_exists('trans') == false) {

    function trans($text, $params = []) {
        return Wudimei\StaticProxies\Lang::get($text, $params);
    }

}

if (function_exists('backend_url') == false) {

    function backend_url($url, $params = []) {
        return config("app.backend_url") . $url;
    }

}

if (function_exists('array_only') == false) {

    function array_only($array, $keys) {
        return Wudimei\ArrayHelper::only($array, $keys);
    }

}

if (function_exists('array_divide') == false) {

    function array_divide($arr) {
        return Wudimei\ArrayHelper::divide($arr);
    }

}

if (function_exists('array_except') == false) {

    function array_except($array, $keys) {
        return Wudimei\ArrayHelper::except($array, $keys);
    }

}

if (function_exists('array_fetch') == false) {

    function array_fetch($array, $keys) {
        return Wudimei\ArrayHelper::fetch($array, $keys);
    }

}

if (function_exists('array_getColumn') == false) {

    function array_getColumn($array, $columnName) {
        return Wudimei\ArrayHelper::getColumn($array, $columnName);
    }

}

if (function_exists('array_groupBy') == false) {

    function array_groupBy($array_2d, $fieldName) {
        return Wudimei\ArrayHelper::groupBy($array_2d, $fieldName);
    }

}

if (function_exists('array_set') == false) {

    function array_set($array, $keys, $value) {
        return Wudimei\ArrayHelper::set($array, $keys, $value);
    }

}

if (function_exists('array_toAssoc') == false) {

    function array_toAssoc($array_2d, $keyFiledName, $valueFieldName) {
        return Wudimei\ArrayHelper::toAssoc($array_2d, $keyFiledName, $valueFieldName);
    }

}
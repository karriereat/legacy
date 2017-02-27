<?php

if (!function_exists('dd')) {
    function dd($value)
    {
        var_dump($value);
        die();
    }
}

if (!function_exists('session')) {
    /**
     * @param null $key
     * @param null $default
     * @return \Karriere\Legacy\Session|null|void
     */
    function session($key = null, $default = null)
    {
        $session = \Karriere\Legacy\Bootstrap::session();

        if (is_null($key)) {
            return $session;
        }

        if (is_array($key)) {
            foreach ($key as $index => $value) {
                $session->put($index, $value);
            }
            return true;
        }

        return $session->get($key, $default);
    }
}

if (!function_exists('redirect')) {
    function redirect($url, $statusCode = 302)
    {
        return new \Karriere\Legacy\Redirector($url, $statusCode);
    }
}
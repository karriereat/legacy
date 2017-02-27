<?php

namespace Karriere\Legacy;

class Bootstrap
{
    /** @var Session */
    private static $session;

    public static function initialize()
    {
        self::$session = new Session();
        
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'helpers.php';
    }

    /**
     * @return Session
     */
    public static function session()
    {
        return static::$session;
    }
}
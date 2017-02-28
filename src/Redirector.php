<?php

namespace Karriere\Legacy;

class Redirector
{
    private $url;
    private $statusCode;

    /** @var Session */
    private $session;

    public function __construct($url, $statusCode = 302)
    {
        $this->url = $url;
        $this->statusCode = $statusCode;

        $this->session = Bootstrap::session();
    }

    /**
     * add a flash message to the session
     *
     * @param $key string the flash message key
     * @param $value the flash message value
     * @return $this
     */
    public function with($key, $value)
    {
        $this->session->flash($key, $value);
        return $this;
    }

    /**
     * do the actual redirect
     */
    public function send()
    {
        header('Location: ' . $this->url, true, $this->statusCode);
        exit();
    }
}
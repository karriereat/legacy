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

        $this->session = Bootstrap::getSession();
    }

    public function with($key, $value)
    {
        $this->session->flash($key, $value);
        return $this;
    }

    public function send()
    {
        header('Location: ' . $this->url, true, $this->statusCode);
        exit();
    }
}
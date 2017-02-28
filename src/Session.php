<?php

namespace Karriere\Legacy;

class Session
{
    const FLASH_MESSAGES = 'flash_messages';

    public function __construct()
    {
        $this->invalidateFlashMessages();
    }

    /**
     * get value from session
     *
     * @param $key string the session key to retrieve
     * @param null $default mixed the default value if no data is found in session
     * @return null|mixed
     */
    public function get($key, $default = null)
    {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }

        if (array_key_exists($key, $_SESSION[self::FLASH_MESSAGES])) {
            return $_SESSION[self::FLASH_MESSAGES][$key]['value'];
        }

        return $default;
    }

    /**
     * store data in session
     *
     * @param $key string the session key to store
     * @param $value mixed the value to store in the session
     */
    public function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * delete a session entry
     *
     * @param $key string the key to delete
     */
    public function forget($key)
    {
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * clear all session entries
     */
    public function flush()
    {
        session_unset();
    }

    /**
     * regenerate the session id
     *
     * @param $deleteOldSession bool indicates if the old session data should be used in the new session or not
     */
    public function regenerate($deleteOldSession = false)
    {
        session_regenerate_id($deleteOldSession);
    }

    /**
     * add a flash message to the session
     * it will be only available on the subsequent request
     *
     * @param $key string the flash message key
     * @param $value mixed the flash message value
     */
    public function flash($key, $value)
    {
        $messages = $this->get(self::FLASH_MESSAGES, []);

        $messages[$key] = [
            'value' => $value,
            'lifetime' => 0
        ];

        $this->put(self::FLASH_MESSAGES, $messages);
    }

    /**
     * invalidate all old flash messages
     */
    private function invalidateFlashMessages()
    {
        $filteredMessages = [];
        $messages = $this->get(self::FLASH_MESSAGES, []);

        if (!empty($messages)) {
            foreach ($messages as $key => $data) {
                $data['lifetime']++;

                if ($data['lifetime'] < 2) {
                    $filteredMessages[$key] = $data;
                }
            }
        }

        $this->put(self::FLASH_MESSAGES, $filteredMessages);
    }
}
<?php

namespace Karriere\Legacy;

class Session
{
    const FLASH_MESSAGES = 'flash_messages';

    public function __construct()
    {
        $this->invalidateFlashMessages();
    }

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

    public function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function flash($key, $value)
    {
        $messages = $this->get(self::FLASH_MESSAGES, []);

        $messages[$key] = [
            'value' => $value,
            'lifetime' => 0
        ];

        $this->put(self::FLASH_MESSAGES, $messages);
    }

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
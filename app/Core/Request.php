<?php

namespace Core;

class Request
{
    /**
     * Convert all $_SERVER constant values to
     * object properties
     * 
     * @return void 
     */
    function __construct()
    {
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    /**
     * 
     * @param mixed $string 
     * @return string|string[] 
     */
    private function toCamelCase($string)
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);
        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }

    public function getBody()
    {
        $body = null;
        if ($this->requestMethod === "GET") {
            return;
        }
        if ($this->requestMethod == "POST") {
            $result = array();
            foreach ($_POST as $key => $value) {
                $result[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $result;
        }

        return $body;
    }
}

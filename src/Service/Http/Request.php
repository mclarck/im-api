<?php


namespace App\Service\Http;


class Request
{

    /**
     * @param string $key
     * @return mixed|null
     */
    public static function getHeader(string $key)
    {
        if (\strtolower($key) === "content-type") {
            return isset($_SERVER["CONTENT_TYPE"]) ? $_SERVER["CONTENT_TYPE"] : null;
        }
        if (\strtolower($key) === "content-length") {
            return isset($_SERVER["CONTENT_LENGTH"]) ? $_SERVER["CONTENT_LENGTH"] : null;
        }
        $key = str_replace(' ', '_', $key);
        $key = str_replace('-', '_', $key);
        $key = strtoupper($key);

        return isset($_SERVER["HTTP_" . $key]) ? $_SERVER["HTTP_" . $key] : null;
    }
}
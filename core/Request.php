<?php

namespace core;

class Request
{
    public array $params = [];
    // private array $routeParams = [];

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getUrl()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    public function isDelete(): bool
    {
        return $this->getMethod() === 'delete';
    }

    public function isPut(): bool
    {
        return $this->getMethod() === 'put';
    }

    public function isPatch(): bool
    {
        return $this->getMethod() === 'patch';
    }

    public function get($input = false)
    {
        if (!$input) {
            $data = [];
            foreach ($_REQUEST as $field => $value) {
                $data[$field] = self::sanitize($value);
            }
            return $data;
        }
        return array_key_exists($input, $_REQUEST) ? self::sanitize($_REQUEST[$input]) : false;
    }

    public static function sanitize($dirty)
    {
        return htmlentities(trim($dirty), ENT_QUOTES, "UTF-8");
    }

    /**
     * @param $params
     * @return self
     */
    public function setParams($params): Request
    {
        $this->params = $params;
        return $this;
    }

    public function Params(): array
    {
        return $this->params;
    }

    public function getParam($param, $default = null)
    {
        return $this->params[$param] ?? $default;
    }
}
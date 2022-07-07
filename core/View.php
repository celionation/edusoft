<?php

namespace core;

use Exception;

class View
{
    public string $title = '';
    protected string $view;
    protected array $params = [];

    public function __construct(string $view, array $params = [])
    {
        $this->params = $params;
        $this->view = $view;

    }

    public static function make(string $view, array $params = []): View
    {
        return new static($view, $params);
    }

    /**
     * @throws Exception
     */
    public function render(): string
    {
        $layoutName = Application::$app->layout;
        if (Application::$app->controller) {
            $layoutName = Application::$app->controller->layout;
        }
        $viewContent = $this->renderViewOnly($this->view, $this->params);
        ob_start();
        include_once Application::$ROOT_DIR . "/src/views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @throws Exception
     */
    public function renderViewOnly($view, array $params): string
    {
        $viewPath = Application::$ROOT_DIR . "/src/views/$view.php";

        if (!file_exists($viewPath)) {
            throw new Exception(Errors::get('5001'), 5001);
        }

        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include $viewPath;
        return (string) ob_get_clean();
    }

    public static function component($path)
    {
        $fullPath = Application::$ROOT_DIR . "/src/views/components/$path.php";
        if (file_exists($fullPath)) {
            include($fullPath);
        }
    }

    public static function partial($path)
    {
        $fullPath = Application::$ROOT_DIR . "/src/views/partials/$path.php";
        if (file_exists($fullPath)) {
            include($fullPath);
        }
    }

    /**
     * @throws Exception
     */
    public function __toString()
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }
}
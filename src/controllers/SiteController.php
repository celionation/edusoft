<?php

namespace src\controllers;

use core\View;
use Exception;
use core\Controller;

class SiteController extends Controller
{
    public function onConstruct()
    {
        $this->setLayout('main');
    }

    /**
     * @throws Exception
     */
    public function index(): View
    {
        $view = [
            
        ];

        return View::make('pages/home', $view);
    }

}
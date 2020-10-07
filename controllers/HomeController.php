<?php

class HomeController
{

    public function home($smarty)
    {
        $smarty->display('index.tpl');
    }

    public function notfound($smarty)
    {
        $smarty->display('404.tpl');
    }

    public function register($smarty)
    {
        $smarty->display('register.tpl');
    }
}
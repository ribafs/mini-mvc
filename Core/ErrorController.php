<?php
declare(strict_types = 1);
namespace Core;

class ErrorController
{
    public function index($type, $return)
    {
        // load views
        require APP . 'Views/_includes/header.phtml';
        require APP . 'Views/error/index.phtml';
        require APP . 'Views/_includes/footer.phtml';
    }
}


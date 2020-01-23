<?php

class View
{
    public $blah;

    public $msg;


    function __construct()
    {

    }

    public function render($name, $noInclude=false)
    {
        if ($noInclude==true)
        {
            require 'view/'.$name.'.php';
        }
        else
        {
            require 'view/header.php';
            require 'view/'.$name.'.php';
            require 'view/footer.php';
        }

    }
}
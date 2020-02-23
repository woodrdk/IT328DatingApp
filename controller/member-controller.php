<?php

class MemberController
{
    private $_f3;

    public function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    public function home()
    {

        $template = new Template();
        echo $template->render('views/home.html');
    }
}
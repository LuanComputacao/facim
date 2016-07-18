<?php
/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 01:08
 */
class Home extends Controller
{

    /**
     * Home constructor.
     */
    function index ()
    {
        $template = $this->loadView('home');
        $template->show();
    }


}
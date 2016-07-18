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
    function index()
    {
        $template = $this->loadView('home');

        $pessoa = $this->loadModel('Pessoa');
        $pessoa->getPessoa('lu');

        $template->set('pessoa', $pessoa->getPessoa());
        $template->set('title', $this->config['title']);
        $template->show();
    }


}
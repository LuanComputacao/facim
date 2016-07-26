<?php


class Home extends Controller
{

    /**
     * Home constructor.
     */
    function index()
    {
        $template = $this->loadView('home');

        $pessoa = $this->loadModel('Pessoas');

        $template->set('pessoas',$pessoa->getPessoas());
        $template->set('title', $this->config['title']);
        $template->show();
    }


}
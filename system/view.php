<?php

class View
{
    private $pageVars = array();
    private $template;

    public function __construct($template)
    {
        $this->template = VIEW_DIR. $template .'.php';
    }

    public function set($var, $val)
    {
        $this->pageVars[$var] = $val;
    }

    public function show()
    {
        extract($this->pageVars);

        ob_start();
        require($this->template);
        echo ob_get_clean();
    }
}
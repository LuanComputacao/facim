<?php

/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 13:41
 */
class Controller
{
    protected $config;

    /**
     * Controller constructor.
     */
    public function __construct()
    {

        global $config;
        $this->config = $config;
    }

    protected function loadModel($model)
    {
        $modelPath = MODEL_DIR . $model . '.php';
        try {
            require_once($modelPath);
            return new $model;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected function loadView($view = 'index')
    {
        return new View($view);
    }

    protected function getPost()
    {
        $post=array();
        foreach ($_POST as $key => $value) {
            $post[$key] = $value;
        }
        return $post;
    }
}
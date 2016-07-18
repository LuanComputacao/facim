<?php

/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 13:41
 */
class Controller
{
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
}
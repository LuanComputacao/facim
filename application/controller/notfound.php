<?php
/**
 * Created by PhpStorm.
 * User: luan
 * Date: 17/07/16
 * Time: 15:32
 */
class NotFound extends Controller
{
    public function index()
    {
        $this->error404();
    }

    private function error404()
    {
        echo 'Página não encontrada';
    }
}

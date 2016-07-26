<?php

class NotFound extends Controller
{
    public function index()
    {
        $this->error404();
    }

    private function error404()
    {
        $template = $this->loadView('notfound');
        $template->show();
    }
}

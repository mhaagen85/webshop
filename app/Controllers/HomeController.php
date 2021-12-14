<?php

namespace Controllers;

class HomeController extends AbstractController
{

    /**
     * @param $path
     * @return mixed|void
     */
    public function view($path)
    {
        $data['template'] = $path;
        $this->renderTemplate($data);
    }

}
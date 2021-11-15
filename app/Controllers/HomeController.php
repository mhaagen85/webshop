<?php

namespace Controllers;

class HomeController extends AbstractController
{
    /*
 * View
 */
    public function view($path)
    {
        $data['template'] = $path;
        $this->renderTemplate($data);
    }


}
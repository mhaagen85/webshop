<?php

namespace Controllers;

class HomeController extends AbstractController
{
    /*
 * View
 */
    public function view($path)
    {
        $this->renderTemplate($path, []);
    }


}
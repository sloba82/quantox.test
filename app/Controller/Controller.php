<?php

namespace App\Controller;

/**
 * Class BaseController
 */
class Controller
{

    /**
     * Method for creating view.
     *
     * @param string $view_name
     * @param array|null|string $data
     */
    public function createView(string $view_name, $data = null)
    {
        if (file_exists("./view/$view_name.php")) {
            require_once("./view/$view_name.php");
        }
    }
}
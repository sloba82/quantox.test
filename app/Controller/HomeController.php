<?php
namespace App\Controller;


use App\Controller\Controller;

class HomeController extends Controller {

    public function index()
    {
        $data = 'Hello Students';
        $this->createView('index', $data);
    }

}

<?php
namespace App\Controller;


use App\Controller\Controller;

class HomeController extends Controller {

    public function index()
    {
        $data = 'Hello From homepage';
        $this->createView('index', $data);
    }

}

<?php

use App\Controller\HomeController;
use App\Route;

Route::add('/', function () {
  $home = new HomeController();
  $home->index();
   
});

Route::run('/');

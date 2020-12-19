<?php

use App\Controller\HomeController;
use App\Controller\StudentController;
use App\Repositories\StudentRepository;
use App\Route;

Route::add('/', function () {
  $home = new HomeController();
  $home->index();
   
});

Route::add('/students', function () {
  $student = new StudentController(new StudentRepository());
  $student->index();
});

Route::run('/');

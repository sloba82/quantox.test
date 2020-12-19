<?php

use App\Controller\HomeController;
use App\Controller\StudentController;
use App\Repositories\StudentRepository;
use App\Services\StudentService;
use App\Route;

Route::add('/', function () {
  $home = new HomeController();
  $home->index();
   
});

Route::add('/students', function () {
  $student = new StudentController(new StudentRepository());
  $student->index();
});

Route::add('/students/([0-9]*)', function ($studentId) {
  $studentCtrl = new StudentController(new StudentRepository());
  $studentCtrl->getStudent($studentId, new StudentService(new StudentRepository()));
});

Route::run('/');

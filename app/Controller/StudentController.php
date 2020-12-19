<?php

namespace App\Controller;

use App\Repositories\StudentRepository;

/**
 * Class StudentController
 * @package App\Controller
 */
class StudentController extends Controller
{
    /**
     * @var StudentRepository
     */
    private StudentRepository $studentRepository;

 
    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

  
    public function index()
    {
        $students = $this->studentRepository->getStudents();

        try {
            $this->createView('students', $students);
        } catch (\Exception $exception) {
            throw new Exception("Can not get students");
        }
    }

}

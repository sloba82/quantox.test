<?php

namespace App\Controller;

use App\Repositories\StudentRepository;
use App\Services\StudentService;

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

    /**
     *  Retuns list of students
     */
    public function index()
    {
        $students = $this->studentRepository->getStudents();

        try {
           return $this->createView('students', $students);
        } catch (\Exception $exception) {
            throw new Exception("Can't get all students");
        }
    }

    /**
     * Returns single student
     */
    public function getStudent(int $studentId, StudentService $studentService)
    {
        try {
            $studentData = $studentService->getStudent($studentId);
            return $this->createView('student_single', $studentData);
        } catch (\Exception $exception) {
            throw new Exception("Can't get student");
        }

       
    }
}

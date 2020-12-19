<?php

namespace App\Repositories;

use App\Database\Db;

/**
 * Class StudentRepository
 * @package App\Repositories
 */
class StudentRepository extends Db
{
    /**
     * Method for getting all students.
     *
     * @return array
     */
    public function getStudents() : array
    {
        return self::getData('
            SELECT students.id AS student_id, students.full_name, school_boards.name AS sb_name, students.created_at 
            FROM students 
            LEFT JOIN school_boards 
            ON students.school_board_id = school_boards.id
        ');
    }


    /**
     * Method for getting all students.
     *
     * @param int $studentId
     * @return array
     */
    public function getStudent(int $studentId) : array
    {
        return self::getData('
            SELECT s.id, s.full_name, sb.name AS school_board, g.grade
            FROM students AS s
            LEFT JOIN school_boards AS sb ON s.school_board_id = sb.id
            RIGHT JOIN grades AS g ON s.id = g.student_id
            WHERE s.id = ' . $studentId
        );
    }

}

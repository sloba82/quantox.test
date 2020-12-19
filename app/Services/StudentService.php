<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use SimpleXMLElement;

/**
 * Class StudentService
 * @package App\Services
 */
class StudentService
{
    /**
     * @var StudentRepository
     */
    private StudentRepository $studentRepository;

    /**
     * StudentController
     * @param StudentRepository $studentRepository
     */
    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }


    /**
     * @param int $studentId
     * @return bool|string
     */
    public function getStudent(int $studentId)
    {
        $data = $this->studentRepository->getStudent($studentId);
        return $this->mapStudentData($data);
    }


    /**
     * @param array $studentData
     * @return bool|string
     */
    private function mapStudentData(array $studentData)
    {
        $result = [];
        $board = null;

        foreach ($studentData as $key => $item) {
            if (!$board) {
                $board = $item['school_board'];
            }

            if (!isset($result['student_id'])) {
                $result['student_id'] = $item['id'];
            }

            if (!isset($result['name'])) {
                $result['name'] = $item['full_name'];
            }

            $result['list_of_grades']['garde_' . $key] = $item['grade'];
        }

        return $this->calculateGrades($result, $board);
    }

    /**
     * @param array $data
     * @param string $board
     * @return bool|string
     */
    private function calculateGrades($data, $board)
    {
        if ($board === 'CSM') {
            $data['averages'] = array_sum($data['list_of_grades']) / count($data['list_of_grades']);
            $data['final_result'] = $data['averages'] >= 7;

            return json_encode($data);
        } else {
            sort($data['list_of_grades']);
            array_shift($data['list_of_grades']);
            $data['final_result'] =
                array_sum($data['list_of_grades']) / count($data['list_of_grades']) > 8 && count($data['list_of_grades']) > 2 ? 'Passed' : 'Failed';

            $xmlStudentInfo = new SimpleXMLElement("<?xml version=\"1.0\"?><user_info></user_info>");
            $xmlStudentInfo = $this->toXml($data, $xmlStudentInfo);

            return $xmlStudentInfo->asXML();
        }
    }

    /**
     * @param array $array
     * @param SimpleXMLElement $xmlStudentInfo
     * @return SimpleXMLElement
     */
    private function toXml($array, SimpleXMLElement $xmlStudentInfo)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $subNode = $xmlStudentInfo->addChild("$key");
                    $this->toXml($value, $subNode);
                } else {
                    $subNode = $xmlStudentInfo->addChild("item$key");
                    $this->toXml($value, $subNode);
                }
            } else {
                $xmlStudentInfo->addChild("$key", htmlspecialchars("$value"));
            }
        }

        return $xmlStudentInfo;
    }
}

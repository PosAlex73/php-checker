<?php

namespace App\Form;

use App\Exceptions\BadValidatedCourseData;
use App\Http\Error\Wrong;
use App\Utils\DD;
use PHPUnit\Util\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class PracticeCheckerForm
{
    protected int $course_id;
    protected int $task_id;
    protected string $code;

    public function preperaCourseData(array $data)
    {
        $this->course_id = $data['course_id'];
        $this->task_id = $data['task_id'];
        $this->code = $data['code'];

        try {
            $this->sanitazeUserData();
        } catch (BadValidatedCourseData $e) {

        }

        return [$this->course_id, $this->task_id, $this->code];
    }

    protected function sanitazeUserData()
    {

    }
}
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
    protected string $type;

    public function preperaCourseData(array $data)
    {
        $this->course_id = $data['course_id'];
        $this->task_id = $data['task_id'];
        $this->code = $data['code'];
        $this->type = $data['type'];

        try {
            $this->sanitazeUserData();
        } catch (BadValidatedCourseData $e) {

        }

        return [
            'course_id' => $this->course_id,
            'task_id' => $this->task_id,
            'code' => $this->code,
            'type' => $this->type
        ];
    }

    protected function sanitazeUserData()
    {

    }
}
<?php

namespace App\Form;

class PracticeCheckerForm
{
    protected int $course_id;
    protected int $task_id;
    protected string $code;

    public function __construct(array $data)
    {
        $this->course_id = $data['course_id'];
        $this->task_id = $data['task_id'];
        $this->code = $data['code'];
        $this->sanitazeUserData();
    }

    protected function sanitazeUserData()
    {

    }


}
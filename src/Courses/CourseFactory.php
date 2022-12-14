<?php

namespace App\Courses;

use PHPUnit\Util\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CourseFactory
{
    protected const COURSES_PARAMETER = 'courses';

    protected array $courseCollection;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->courseCollection = $parameterBag->get(static::COURSES_PARAMETER);
    }

    public function createCourseFromArray(int $course_id, int $task_id, string $code)
    {
        $course = array_search($course_id, $this->courseCollection);

        if (empty($course)) {
            throw new Exception('Course is not exist!');
        }

        /** @var Course $course */
        $course = new $course($course_id, $task_id, $code);

        return $course;
    }
}
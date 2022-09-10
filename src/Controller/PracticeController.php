<?php

namespace App\Controller;

use App\Courses\CourseFactory;
use App\Form\PracticeCheckerForm;
use App\Http\Error\WrongData;
use App\Services\CourseChecker;
use App\Utils\DD;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PracticeController extends AbstractController
{
    #[Route('/test', name: 'app_test', methods: ['POST'])]
    public function practiceCheck(
        Request $request,
        PracticeCheckerForm $checkerForm,
        CourseFactory $courseFactory,
        CourseChecker $checker
    ): Response
    {
        $content = json_decode($request->getContent(), JSON_OBJECT_AS_ARRAY);

        try {
            $validated_data = $checkerForm->preperaCourseData($content);

            $course = $courseFactory->createCourseFromArray(
                $validated_data['course_id'],
                $validated_data['task_id'],
                $validated_data['code']
            );

            $checker->createTaskFile($course);
            $result = $checker->getTaskResult($validated_data['type']);

            return $this->json($result->toArray());

        } catch (\Exception $e) {
            return $this->json((new WrongData())->getErrorMessage());
        }

        return $this->json($request->getContent());
    }
}

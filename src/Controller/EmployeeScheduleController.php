<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Service\IsDayOffService;
use App\Service\ScheduleService;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employee-schedule")
 */
class EmployeeScheduleController extends AbstractController
{
    /**
     * @Route("")
     * @param IsDayOffService $isDayOffService
     * @return JsonResponse
     */
    public function getWorkSchedule(Request $request, EntityManagerInterface $em, IsDayOffService $isDayOffService, ScheduleService $scheduleService): JsonResponse
    {
        $startDate = $request->query->get('startDate');
        if(!$startDate || !preg_match('%\d{4}-\d{2}-\d{2}%', $request->query->get('startDate'))){
            return $this->json(['errors' => ['Invalid date ->' . $startDate ]], JsonResponse::HTTP_BAD_REQUEST);
        }
        $startDate = Carbon::create($request->query->get('startDate'));
        $endDate =  Carbon::create($request->query->get('endDate'));

        $areDaysOff = $isDayOffService->areDaysOff($startDate, $endDate);
        $employeeId = $request->query->get('employeeId');
        $employee = ($em->getRepository(Employee::class))->find($employeeId);
        $schedule =$scheduleService->getEmployeeWorkSchedule($employee, $areDaysOff, $startDate);

        return $this->json($schedule);
    }
}

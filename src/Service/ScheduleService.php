<?php


namespace App\Service;


use App\Entity\Employee;
use DateTimeInterface;

class ScheduleService
{

    /**
     * Creating schedule
     * @param Employee $employee
     * @param array $areDaysOff
     * @param DateTimeInterface $dateStart
     * @return array[]
     */
    public function getEmployeeWorkSchedule(Employee $employee, array $areDaysOff, DateTimeInterface $dateStart): array
    {
        $schedule = [];
        foreach($areDaysOff as $isDayOff){
            if($isDayOff === '0'){
                $schedule[] = $this->createWorkScheduleItem($dateStart, $employee);
            }

            $dateStart->add(date_interval_create_from_date_string('1 day'));
        }

        return [
            'schedule' => $schedule
        ];
    }

    /**
     * Creating schedule item
     * @param DateTimeInterface $dateStart
     * @param Employee $employee
     * @return array
     */
    private function createWorkScheduleItem(DateTimeInterface $dateStart, Employee $employee): array
    {
        return [
            'day' => $dateStart->format('Y-m-d'),
            'timeRanges' =>  $this->getWorkTimeRanges($employee)
        ];
    }

    /**
     * Creating timeRange fore a day
     * @param Employee $employee
     * @return \string[][]
     */
    private function getWorkTimeRanges(Employee $employee): array
    {
        return [
            [
                'start' => $employee->getDayStart() . ':00',
                'end' =>$employee->getLunchStart() . ':00'
            ],
            [
                'start' => $employee->getLunchStart() + $employee->getLunchDuration() . ':00',
                'end' =>$employee->getDayEnd() . ':00'
            ]
        ];
    }

}
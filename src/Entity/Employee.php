<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $dayStart;

    /**
     * @ORM\Column(type="smallint", length=255)
     */
    private $dayEnd;

    /**
     * @ORM\Column(type="integer")
     */
    private $lunchStart;

    /**
     * @ORM\Column(type="smallint")
     */
    private $lunchDuration;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getDayStart(): ?int
    {
        return $this->dayStart;
    }

    /**
     * @param int $dayStart
     * @return $this
     */
    public function setDayStart(int $dayStart): self
    {
        $this->dayStart = $dayStart;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDayEnd(): ?string
    {
        return $this->dayEnd;
    }

    /**
     * @param string $dayEnd
     * @return $this
     */
    public function setDayEnd(string $dayEnd): self
    {
        $this->dayEnd = $dayEnd;

        return $this;
    }

    public function getLunchStart(): ?int
    {
        return $this->lunchStart;
    }

    public function setLunchStart(int $lounchStart): self
    {
        $this->lunchStart = $lounchStart;

        return $this;
    }

    public function getLunchDuration(): ?int
    {
        return $this->lunchDuration;
    }

    public function setLunchDuration(int $lunchDuration): self
    {
        $this->lunchDuration = $lunchDuration;

        return $this;
    }
}

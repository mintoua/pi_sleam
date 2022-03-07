<?php

namespace App\Entity;

use App\Repository\RedZoneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RedZoneRepository::class)
 */
class RedZone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $Long1;

    /**
     * @ORM\Column(type="float")
     */
    private $Long2;

    /**
     * @ORM\Column(type="float")
     */
    private $Lat1;

    /**
     * @ORM\Column(type="float")
     */
    private $Lat2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLong1(): ?float
    {
        return $this->Long1;
    }

    public function setLong1(float $Long1): self
    {
        $this->Long1 = $Long1;

        return $this;
    }

    public function getLong2(): ?float
    {
        return $this->Long2;
    }

    public function setLong2(float $Long2): self
    {
        $this->Long2 = $Long2;

        return $this;
    }

    public function getLat1(): ?float
    {
        return $this->Lat1;
    }

    public function setLat1(float $Lat1): self
    {
        $this->Lat1 = $Lat1;

        return $this;
    }

    public function getLat2(): ?float
    {
        return $this->Lat2;
    }

    public function setLat2(float $Lat2): self
    {
        $this->Lat2 = $Lat2;

        return $this;
    }
}

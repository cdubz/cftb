<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaceDayRepository")
 */
class RaceDay
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Race", mappedBy="raceDay", orphanRemoval=true)
     */
    private $races;

    public function __construct()
    {
        $this->races = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Race[]
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    /**
     * @param $number
     * @return Race|null The Race object with the specified number.
     */
    public function getRaceByNumber($number): ?Race
    {
        /** @var \App\Entity\Race $race */
        foreach ($this->races as $race) {
            if ($race->getNumber() == $number) {
                return $race;
            }
        }
        return null;
    }

    public function addRace(Race $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races[] = $race;
            $race->setRaceDay($this);
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->races->contains($race)) {
            $this->races->removeElement($race);
            // set the owning side to null (unless already changed)
            if ($race->getRaceDay() === $this) {
                $race->setRaceDay(null);
            }
        }

        return $this;
    }
}

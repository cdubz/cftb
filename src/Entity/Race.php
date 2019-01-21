<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaceRepository")
 */
class Race
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
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surface;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $trackCondition;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RaceEntry", mappedBy="race", orphanRemoval=true)
     * @ORM\OrderBy({"finishPosition" = "ASC"})
     */
    private $entries;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RaceDay", inversedBy="races")
     * @ORM\JoinColumn(nullable=false)
     */
    private $raceDay;

    public function __construct()
    {
        $this->entries = new ArrayCollection();
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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getTrackCondition(): ?string
    {
        return $this->trackCondition;
    }

    public function setTrackCondition(string $trackCondition): self
    {
        $this->trackCondition = $trackCondition;

        return $this;
    }

    /**
     * @return Collection|RaceEntry[]
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function addEntry(RaceEntry $entry): self
    {
        if (!$this->entries->contains($entry)) {
            $this->entries[] = $entry;
            $entry->setRace($this);
        }

        return $this;
    }

    public function removeEntry(RaceEntry $entry): self
    {
        if ($this->entries->contains($entry)) {
            $this->entries->removeElement($entry);
            // set the owning side to null (unless already changed)
            if ($entry->getRace() === $this) {
                $entry->setRace(null);
            }
        }

        return $this;
    }

    /**
     * @param int $position Maximum finishPosition to get.
     *
     * @return RaceEntry[]|Collection
     */
    public function getFinishedEntries(int $position): Collection
    {
        $finished = new ArrayCollection();
        /** @var RaceEntry $entry */
        foreach ($this->entries as $entry) {
            $finish_position = $entry->getFinishPosition();
            if ($finish_position && $finish_position <= $position) {
                $finished->add($entry);
            }
        }
        return $finished;
    }

    /**
    * @return Collection|RaceEntry[]
    */
    public function getScratchedEntries(): Collection
    {
        $scratched = new ArrayCollection();
        /** @var RaceEntry $entry */
        foreach ($this->entries as $entry) {
            if ($entry->getScratched()) {
                $scratched->add($entry);
            }
        }
        return $scratched;
    }

    /**
     * @return Collection|RaceEntry[]
     */
    public function getAlsoRanEntries(): Collection
    {
        $also_ran = new ArrayCollection();
        /** @var RaceEntry $entry */
        foreach ($this->entries as $entry) {
            if ($entry->getAlsoRan()) {
                $also_ran->add($entry);
            }
        }
        return $also_ran;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getRaceDay(): ?RaceDay
    {
        return $this->raceDay;
    }

    public function setRaceDay(?RaceDay $raceDay): self
    {
        $this->raceDay = $raceDay;

        return $this;
    }
}

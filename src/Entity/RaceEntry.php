<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaceEntryRepository")
 */
class RaceEntry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $horseName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $finishPosition;

    /**
     * @ORM\Column(type="boolean")
     */
    private $alsoRan;

    /**
     * @ORM\Column(type="boolean")
     */
    private $scratched;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $winPayoff;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $placePayoff;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $showPayoff;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Race", inversedBy="entries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHorseName(): ?string
    {
        return $this->horseName;
    }

    public function setHorseName(string $horseName): self
    {
        $this->horseName = $horseName;

        return $this;
    }

    public function getFinishPosition(): ?int
    {
        return $this->finishPosition;
    }

    public function setFinishPosition(?int $finishPosition): self
    {
        $this->finishPosition = $finishPosition;

        return $this;
    }

    public function getAlsoRan(): ?bool
    {
        return $this->alsoRan;
    }

    public function setAlsoRan(bool $alsoRan): self
    {
        $this->alsoRan = $alsoRan;

        return $this;
    }

    public function getScratched(): ?bool
    {
        return $this->scratched;
    }

    public function setScratched(bool $scratched): self
    {
        $this->scratched = $scratched;

        return $this;
    }

    public function getWinPayoff()
    {
        return $this->winPayoff;
    }

    public function setWinPayoff($winPayoff): self
    {
        $this->winPayoff = $winPayoff;

        return $this;
    }

    public function getPlacePayoff()
    {
        return $this->placePayoff;
    }

    public function setPlacePayoff($placePayoff): self
    {
        $this->placePayoff = $placePayoff;

        return $this;
    }

    public function getShowPayoff()
    {
        return $this->showPayoff;
    }

    public function setShowPayoff($showPayoff): self
    {
        $this->showPayoff = $showPayoff;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }
}

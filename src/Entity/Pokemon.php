<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PokemonRepository::class)
 */
class Pokemon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name_en;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="float")
     */
    private $size;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private $hatching_cycle;

    /**
     * @ORM\Column(type="integer")
     */
    private $hatching_step;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $exp_curve;

    /**
     * @ORM\Column(type="float")
     */
    private $male_rate;

    /**
     * @ORM\Column(type="float")
     */
    private $female_rate;

    /**
     * @ORM\Column(type="integer")
     */
    private $capture_rate;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=Generation::class, inversedBy="pokemon")
     * @ORM\JoinColumn(nullable=false)
     */
    private $generation;

    /**
     * @ORM\Column(type="integer")
     */
    private $national_number;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->name_en;
    }

    public function setNameEn(string $name_en): self
    {
        $this->name_en = $name_en;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHatchingCycle(): ?int
    {
        return $this->hatching_cycle;
    }

    public function setHatchingCycle(int $hatching_cycle): self
    {
        $this->hatching_cycle = $hatching_cycle;

        return $this;
    }

    public function getHatchingStep(): ?int
    {
        return $this->hatching_step;
    }

    public function setHatchingStep(int $hatching_step): self
    {
        $this->hatching_step = $hatching_step;

        return $this;
    }

    public function getExpCurve(): ?string
    {
        return $this->exp_curve;
    }

    public function setExpCurve(string $exp_curve): self
    {
        $this->exp_curve = $exp_curve;

        return $this;
    }

    public function getMaleRate(): ?float
    {
        return $this->male_rate;
    }

    public function setMaleRate(float $male_rate): self
    {
        $this->male_rate = $male_rate;

        return $this;
    }

    public function getFemaleRate(): ?float
    {
        return $this->female_rate;
    }

    public function setFemaleRate(float $female_rate): self
    {
        $this->female_rate = $female_rate;

        return $this;
    }

    public function getCaptureRate(): ?int
    {
        return $this->capture_rate;
    }

    public function setCaptureRate(int $capture_rate): self
    {
        $this->capture_rate = $capture_rate;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getGeneration(): ?Generation
    {
        return $this->generation;
    }

    public function setGeneration(?Generation $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function getNationalNumber(): ?int
    {
        return $this->national_number;
    }

    public function setNationalNumber(int $national_number): self
    {
        $this->national_number = $national_number;

        return $this;
    }
}

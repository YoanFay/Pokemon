<?php

namespace App\Entity;

use App\Repository\TypeEfficiencyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeEfficiencyRepository::class)
 */
class TypeEfficiency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $attack_type;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $defense_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $multiplier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttackType(): ?Type
    {
        return $this->attack_type;
    }

    public function setAttackType(?Type $attack_type): self
    {
        $this->attack_type = $attack_type;

        return $this;
    }

    public function getDefenseType(): ?Type
    {
        return $this->defense_type;
    }

    public function setDefenseType(?Type $defense_type): self
    {
        $this->defense_type = $defense_type;

        return $this;
    }

    public function getMultiplier(): ?int
    {
        return $this->multiplier;
    }

    public function setMultiplier(int $multiplier): self
    {
        $this->multiplier = $multiplier;

        return $this;
    }
}

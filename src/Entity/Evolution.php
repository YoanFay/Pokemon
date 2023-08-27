<?php

namespace App\Entity;

use App\Repository\EvolutionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvolutionRepository::class)
 */
class Evolution
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Pokemon::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $base_pokemon;

    /**
     * @ORM\ManyToOne(targetEntity=Pokemon::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $evolution_pokemon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $weather_condition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $use_object;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hold_object;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="boolean")
     */
    private $happiness = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hour;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $learn_attack;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $special;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class)
     */
    private $learnAttackType;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class)
     */
    private $party_type;

    /**
     * @ORM\ManyToOne(targetEntity=Pokemon::class)
     */
    private $party_pokemon;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $stats;

    /**
     * @ORM\Column(type="boolean")
     */
    private $trade = false;

    /**
     * @ORM\ManyToOne(targetEntity=Pokemon::class)
     */
    private $trade_with;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBasePokemon(): ?Pokemon
    {
        return $this->base_pokemon;
    }

    public function setBasePokemon(?Pokemon $base_pokemon): self
    {
        $this->base_pokemon = $base_pokemon;

        return $this;
    }

    public function getEvolutionPokemon(): ?Pokemon
    {
        return $this->evolution_pokemon;
    }

    public function setEvolutionPokemon(?Pokemon $evolution_pokemon): self
    {
        $this->evolution_pokemon = $evolution_pokemon;

        return $this;
    }

    public function getWeatherCondition(): ?string
    {
        return $this->weather_condition;
    }

    public function setWeatherCondition(?string $weather_condition): self
    {
        $this->weather_condition = $weather_condition;

        return $this;
    }

    public function getUseObject(): ?string
    {
        return $this->use_object;
    }

    public function setUseObject(?string $use_object): self
    {
        $this->use_object = $use_object;

        return $this;
    }

    public function getHoldObject(): ?string
    {
        return $this->hold_object;
    }

    public function setHoldObject(?string $hold_object): self
    {
        $this->hold_object = $hold_object;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function isHappiness(): ?bool
    {
        return $this->happiness;
    }

    public function setHappiness(bool $happiness): self
    {
        $this->happiness = $happiness;

        return $this;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(?string $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getLearnAttack(): ?string
    {
        return $this->learn_attack;
    }

    public function setLearnAttack(?string $learn_attack): self
    {
        $this->learn_attack = $learn_attack;

        return $this;
    }

    public function getSpecial(): ?string
    {
        return $this->special;
    }

    public function setSpecial(?string $special): self
    {
        $this->special = $special;

        return $this;
    }

    public function getLearnAttackType(): ?Type
    {
        return $this->learnAttackType;
    }

    public function setLearnAttackType(?Type $learnAttackType): self
    {
        $this->learnAttackType = $learnAttackType;

        return $this;
    }

    public function getPartyType(): ?Type
    {
        return $this->party_type;
    }

    public function setPartyType(?Type $party_type): self
    {
        $this->party_type = $party_type;

        return $this;
    }

    public function getPartyPokemon(): ?Pokemon
    {
        return $this->party_pokemon;
    }

    public function setPartyPokemon(?Pokemon $party_pokemon): self
    {
        $this->party_pokemon = $party_pokemon;

        return $this;
    }

    public function getStats(): ?string
    {
        return $this->stats;
    }

    public function setStats(?string $stats): self
    {
        $this->stats = $stats;

        return $this;
    }

    public function isTrade(): ?bool
    {
        return $this->trade;
    }

    public function setTrade(bool $trade): self
    {
        $this->trade = $trade;

        return $this;
    }

    public function getTradeWith(): ?Pokemon
    {
        return $this->trade_with;
    }

    public function setTradeWith(?Pokemon $trade_with): self
    {
        $this->trade_with = $trade_with;

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DescriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DescriptionRepository::class)
 * @ApiResource()
 */
class Description
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
    private $delivery;

    /**
     * @ORM\Column(type="float")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unit;

    /**
     * @ORM\Column(type="float")
     */
    private $unitPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $htAmount;

    /**
     * @ORM\Column(type="float")
     */
    private $ttcAmount;

    /**
     * @ORM\ManyToOne(targetEntity=Estimate::class, inversedBy="descriptions")
     */
    private $estimate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDelivery(): ?string
    {
        return $this->delivery;
    }

    public function setDelivery(string $delivery): self
    {
        $this->delivery = $delivery;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getHtAmount(): ?float
    {
        return $this->htAmount;
    }

    public function setHtAmount(float $htAmount): self
    {
        $this->htAmount = $htAmount;

        return $this;
    }

    public function getTtcAmount(): ?float
    {
        return $this->ttcAmount;
    }

    public function setTtcAmount(float $ttcAmount): self
    {
        $this->ttcAmount = $ttcAmount;

        return $this;
    }

    public function getEstimate(): ?Estimate
    {
        return $this->estimate;
    }

    public function setEstimate(?Estimate $estimate): self
    {
        $this->estimate = $estimate;

        return $this;
    }
}

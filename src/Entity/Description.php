<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DescriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DescriptionRepository::class)
 * @ApiResource(
 *     denormalizationContext={"disabled_type_enforcement"=true}
 * )
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
     * @Assert\NotBlank(message="L'intitulé est obligatoire")
     */
    private $delivery;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="La quantité est obligatoire")
     * @Assert\Type(type="numeric", message="La quantité doit être au format numérique")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="l'unité de mesure est obligatoire")
     */
    private $unit;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Le prix unitaire est obligatoire")
     * @Assert\Type(type="numeric", message="Le prix unitaire doit être au format numérique")
     */
    private $unitPrice;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Le montant ht est obligatoire")
     * @Assert\Type(type="numeric", message="Le montant ht doit être au format numérique")
     */
    private $htAmount;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Le montant ttc est obligatoire")
     * @Assert\Type(type="numeric", message="Le montant ttc doit être au format numérique")
     */
    private $ttcAmount;

    /**
     * @ORM\ManyToOne(targetEntity=Estimate::class, inversedBy="descriptions")
     * @Assert\NotBlank(message="La description doit être liée à un devis")
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

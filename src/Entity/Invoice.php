<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 *
 * *****dénormalizationContext permet de désactiver la vérificaton symfony sur les float
 * *****et permet donc de mettre en avant l'assert type numeric
 * @ApiResource(
 *     attributes={
 *          "order":{"createdAt":"desc"}
 *     },
 *     denormalizationContext={"disabled_type_enforcement"=true}
 * )
 * @ApiFilter(OrderFilter::class, properties={"ttcAmount", "createdAt"})
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="La date de facture est obligatoire ")
     *
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     *
     */
    private $totalAdvance;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Le montant ht est obligatoire ")
     * @Assert\Type(type="numeric", message="Le montant ht doit être au format numérique")
     */
    private $htAmount;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Le montant ttc est obligatoire ")
     * @Assert\Type(type="numeric", message="Le montant ht doit être au format numérique")
     */
    private $ttcAmount;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="invoices")
     * @Assert\NotBlank(message="La facture doit être liée à un utilisateur")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Advance::class, mappedBy="invoice")
     *
     */
    private $advances;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     */
    private $remaining;

    /**
     * @ORM\ManyToOne(targetEntity=Estimate::class, inversedBy="invoices")
     * @Assert\NotBlank(message="La facture doit être liée à un devis")
     */
    private $estimate;



    public function __construct()
    {
        $this->advances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTotalAdvance(): ?float
    {
        return $this->totalAdvance;
    }

    public function setTotalAdvance(?float $totalAdvance): self
    {
        $this->totalAdvance = $totalAdvance;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Advance[]
     */
    public function getAdvances(): Collection
    {
        return $this->advances;
    }

    public function addAdvance(Advance $advance): self
    {
        if (!$this->advances->contains($advance)) {
            $this->advances[] = $advance;
            $advance->setInvoice($this);
        }

        return $this;
    }

    public function removeAdvance(Advance $advance): self
    {
        if ($this->advances->contains($advance)) {
            $this->advances->removeElement($advance);
            // set the owning side to null (unless already changed)
            if ($advance->getInvoice() === $this) {
                $advance->setInvoice(null);
            }
        }

        return $this;
    }

    public function getRemaining(): ?float
    {
        return $this->remaining;
    }

    public function setRemaining(?float $remaining): self
    {
        $this->remaining = $remaining;

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

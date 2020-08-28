<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EstimateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EstimateRepository::class)
 * @ApiResource(
 *     denormalizationContext={"disabled_type_enforcement"=true}
 * )
 */
class Estimate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="La date de facture est obligatoire")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Le montant hors taxes est obligatoire")
     * @Assert\Type(type="numeric", message="Le montant ht doit être au format numérique")
     */
    private $htAmount;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Le montant ttc est obligatoire")
     * @Assert\Type(type="numeric", message="Le montant ht doit être au format numérique")
     */
    private $ttcAmount;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="estimates")
     * @Assert\NotBlank(message="Le devis doit être lié à un utilisateur")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="estimates")
     * @Assert\NotBlank(message="Le devis doit être lié à un client")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=Description::class, mappedBy="estimate")
     */
    private $descriptions;

    /**
     * @ORM\OneToMany(targetEntity=Invoice::class, mappedBy="estimate")
     */
    private $invoices;

    public function __construct()
    {
        $this->descriptions = new ArrayCollection();
        $this->invoices = new ArrayCollection();
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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection|Description[]
     */
    public function getDescriptions(): Collection
    {
        return $this->descriptions;
    }

    public function addDescription(Description $description): self
    {
        if (!$this->descriptions->contains($description)) {
            $this->descriptions[] = $description;
            $description->setEstimate($this);
        }

        return $this;
    }

    public function removeDescription(Description $description): self
    {
        if ($this->descriptions->contains($description)) {
            $this->descriptions->removeElement($description);
            // set the owning side to null (unless already changed)
            if ($description->getEstimate() === $this) {
                $description->setEstimate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Invoice[]
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): self
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices[] = $invoice;
            $invoice->setEstimate($this);
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): self
    {
        if ($this->invoices->contains($invoice)) {
            $this->invoices->removeElement($invoice);
            // set the owning side to null (unless already changed)
            if ($invoice->getEstimate() === $this) {
                $invoice->setEstimate(null);
            }
        }

        return $this;
    }
}

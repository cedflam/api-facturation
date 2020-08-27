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

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 * @ApiResource(
 *     attributes={
 *          "pagination_enabled"=true,
 *          "order":{"createdAt":"desc"}
 *     },
 *     normalizationContext={"invoices_read"}
 * )
 * @ApiFilter(OrderFilter::class, properties={"ttcAmount", "createdAt"})
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"invoices_read", "customers_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"invoices_read", "customers_read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"invoices_read", "customers_read"})
     */
    private $totalAdvance;

    /**
     * @ORM\Column(type="float")
     * @Groups({"invoices_read", "customers_read"})
     */
    private $htAmount;

    /**
     * @ORM\Column(type="float")
     * @Groups({"invoices_read", "customers_read"})
     */
    private $ttcAmount;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="invoices")
     * @Groups({"invoices_read", "customers_read"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Advance::class, mappedBy="invoice")
     * @Groups({"invoices_read", "customers_read"})
     */
    private $advances;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"invoices_read", "customers_read"})
     */
    private $remaining;

    /**
     * @ORM\ManyToOne(targetEntity=Estimate::class, inversedBy="invoices")
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

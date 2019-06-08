<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\BusinessRepository")
 */
class Business
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $WebsiteUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BusinessType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Service", mappedBy="business", orphanRemoval=true)
     */
    private $Services;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Customer", mappedBy="Business")
     */
    private $customers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="Business", orphanRemoval=true)
     */
    private $appointments;

    public function __construct()
    {
        $this->Services = new ArrayCollection();
        $this->customers = new ArrayCollection();
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->WebsiteUrl;
    }

    public function setWebsiteUrl(?string $WebsiteUrl): self
    {
        $this->WebsiteUrl = $WebsiteUrl;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getBusinessType(): ?string
    {
        return $this->BusinessType;
    }

    public function setBusinessType(string $BusinessType): self
    {
        $this->BusinessType = $BusinessType;

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->Services;
    }

    public function addService(Service $service): self
    {
        if (!$this->Services->contains($service)) {
            $this->Services[] = $service;
            $service->setBusiness($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->Services->contains($service)) {
            $this->Services->removeElement($service);
            // set the owning side to null (unless already changed)
            if ($service->getBusiness() === $this) {
                $service->setBusiness(null);
            }
        }

        return $this;
    }
	
	public function __toString()
	{
        return $this->getName();
    }

    /**
     * @return Collection|Customer[]
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
            $customer->addBusiness($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->contains($customer)) {
            $this->customers->removeElement($customer);
            $customer->removeBusiness($this);
        }

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setBusiness($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->contains($appointment)) {
            $this->appointments->removeElement($appointment);
            // set the owning side to null (unless already changed)
            if ($appointment->getBusiness() === $this) {
                $appointment->setBusiness(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StaffRoleRepository")
 */
class StaffRole
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
    private $Description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Staff", mappedBy="staffRole")
     */
    private $Staffs;

    public function __construct()
    {
        $this->Staffs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Staff[]
     */
    public function getStaffs(): Collection
    {
        return $this->Staffs;
    }

    public function addStaff(Staff $staff): self
    {
        if (!$this->Staffs->contains($staff)) {
            $this->Staffs[] = $staff;
            $staff->setStaffRole($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        if ($this->Staffs->contains($staff)) {
            $this->Staffs->removeElement($staff);
            // set the owning side to null (unless already changed)
            if ($staff->getStaffRole() === $this) {
                $staff->setStaffRole(null);
            }
        }

        return $this;
    }
	
	public function __toString(){
		return $this->getDescription();
	}
}

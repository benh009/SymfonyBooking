<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\OneToMany(targetEntity="App\Entity\client", mappedBy="categorie")
     */
    private $Clients;

    public function __construct()
    {
        $this->Clients = new ArrayCollection();
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
     * @return Collection|client[]
     */
    public function getClients(): Collection
    {
        return $this->Clients;
    }

    public function addClient(client $client): self
    {
        if (!$this->Clients->contains($client)) {
            $this->Clients[] = $client;
            $client->setCategorie($this);
        }

        return $this;
    }

    public function removeClient(client $client): self
    {
        if ($this->Clients->contains($client)) {
            $this->Clients->removeElement($client);
            // set the owning side to null (unless already changed)
            if ($client->getCategorie() === $this) {
                $client->setCategorie(null);
            }
        }

        return $this;
    }
	
	public function __toString(){
		return $this->getDescription();
	}
}

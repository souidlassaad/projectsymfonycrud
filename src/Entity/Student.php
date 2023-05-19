<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
 
    #[Assert\Length(min : 8, max : 8)] 
    //#[Assert\Length(exactly: 8)]
    private ?string $cin = null;
    #[ORM\Column(length: 255)]
   
    #[Assert\NotBlank]
    #[Assert\Length(min: 3)]
    private ?string $nom = null;


    #[ORM\Column(length: 255)]

    #[Assert\NotBlank]
    #[Assert\Length(min: 3)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
   
   
    private ?string $specialite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }
}

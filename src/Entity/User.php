<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 


#[ORM\Entity(repositoryClass: UserRepository::class)]

#[UniqueEntity(
      fields:"email",
         message:"L'émail que vous avez tapé est déjà utilisé !" )]
 
class User 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]

    #[Assert\Length(min : 8)] 
    private ?string $password = null;

    #[Assert\EqualTo(propertyPath : "password", message:"Vous n'avez pas passé le même mot de passe !" )]
    
   private $confirm_password;

   public function getConfirmPassword()
   {
       return $this->confirm_password;
   }

   public function setConfirmPassword($confirm_password)
   {
       $this->confirm_password = $confirm_password;

       return $this;
   }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

   
   
}

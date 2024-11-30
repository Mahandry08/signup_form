<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Assert\NotBlank(message: "Le nom d'utilisateur ne peut pas être vide")]
    #[Assert\Length(min: 3, max: 50)]
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Assert\NotBlank(message: "L'email ne peut pas être vide")]
    #[Assert\Email(message: "Please enter a valid email address.")]
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    #[Assert\NotBlank]
    #[Assert\Length(min: 8, max: 12)]
    private $password;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

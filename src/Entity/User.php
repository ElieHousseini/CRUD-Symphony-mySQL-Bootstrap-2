<?php
/* 
Main goal to implement UserInterface is so Symfony knows that
this class is a real user class. Therefore, I can hash it's password
in the security controller.
*/

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

// info about user interface: https://bit.ly/2GaawDN
use Symfony\Component\Security\Core\User\UserInterface;

// info about validation: https://bit.ly/3cCpIFy
use Symfony\Component\Validator\Constraints as Assert;

// info about UniqueEntity: https://bit.ly/3j64NNS
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 * fields = {"email"},
 * message = "l'email que vous avez indique est deja utitlise !"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passedoit fair minimum 8 caracteres")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Votre mote de confirmation doit etre le meme que celui du mote de pass")
     */
    public $confirm_password;

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

    public function eraseCredentials()
    {
    }
    public function getSalt()
    {
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }
}

<?php
/* 

> Main goal to implement UserInterface is so Symfony knows that
this class is a real user class. Therefore, I can hash it's password
in the security controller.
The functions eraseCredentials(), getSalt() are 
inherited from the interface UserInterface(). So, I am forced to 
write them down, even tho I will not use them.

> The UniqueEntity takes a field, which is the field I want it to be 
unique and a message. Here, I am securing the field from being 
replicated in the level of the back-end not front-end.
To secure it from the front-end, you need to modify the twig files.

> Why the setter functions return $this ?
First, it's a good practice (it helps troubleshooting problems)
Second, it makes us chain setter calls together.
More info here: https://bit.ly/2S5x7Uz (4th post by Hall_of_Famer)

> Why I am returning ['ROLE_USER'] in the function getRoles() ?
it's because we only have 1 type of users which is an admin.
so we only return one type in here. if for example, we have 
customer, admin, ... we return there types in here too.

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

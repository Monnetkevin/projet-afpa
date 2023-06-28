<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="users")
 *
 * @UniqueEntity(fields={"email"}, message="Cette adresse Email est déjà enregistré !!")
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Votre nom doit comporter au minimum {{ limit }} caractères",
     *      maxMessage = "Votre nom doit comporter au maximum {{ limit }} caractères"
     * )
     * @Assert\Regex(pattern="#^[a-zA-Z-]+$#", message="Les caractères spéciaux sont interdits")
     *
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Votre prenom doit comporter au minimum {{ limit }} caractères",
     *      maxMessage = "Votre prenom doit comporter au maximum {{ limit }} caractères"
     * )
     * @Assert\Regex(pattern="#^[a-zA-Z-]+$#", message="Les caractères spéciaux sont interdits")
     *
     * @ORM\Column(type="string", length=25)
     */
    private $prenom;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Votre pseudo doit comporter au minimum {{ limit }} caractères",
     *      maxMessage = "Votre pseudo doit comporter au maximum {{ limit }} caractères"
     * )
     * @Assert\Regex(pattern="#^[a-zA-Z0-9-]+$#", message="Les caractères spéciaux sont interdits")
     *
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;


    /**
     * @Assert\Length(
     *      min = 6,
     *      max = 4000,
     *      minMessage = "Votre Mot de passe doit comporter au minimum {{ limit }} caractères",
     *      maxMessage = "Votre Mot de passe doit comporter au maximum {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @Assert\Email(message="Votre adresse email n'est pas valide !")
     *
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;


    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt(){return null;}
    public function eraseCredentials(){}


}
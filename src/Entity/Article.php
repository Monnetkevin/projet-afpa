<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="articles")
 *
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 *
 *
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Veuillez utiliser votre Nom d'utilisateur !")
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
    private $auteur;
    /**
     * @var string
     *
     * @Assert\NotBlank(message="Donner un titre à votre Article !")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Votre titre doit comporter au minimum {{ limit }} caractères",
     *      maxMessage = "Votre titre doit comporter au maximum {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=250)
     */
    private $titre;
    /**
     * @var string
     *
     * @Assert\NotBlank(message="Donner une desciption à votre Article!")
     * @Assert\Length(
     *      min = 2,
     *      max = 1000,
     *      minMessage = "Votre description doit comporter au minimum {{ limit }} caractères",
     *      maxMessage = "Votre description doit comporter au maximum {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime(message="La valeur n'est pas valide")
     * @Assert\LessThanOrEqual("now")
     *
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;


    /**
     * @var boolean
     *
     * @Assert\Type(type="boolean", message="La valeur n'est pas valide")
     *
     * @ORM\Column(type="boolean")
     */
    private $estPublie;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Ajouter une image jpg ou jpeg.")
     * @Assert\File(mimeTypes={ "image/jpeg", "image/jpg" })
     *
     */
    private $image;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param string $auteur
     */
    public function setAuteur(string $auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated(\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return bool
     */
    public function estPublie()
    {
        return $this->estPublie;
    }

    /**
     * @param bool $estPublie
     */
    public function setEstPublie(bool $estPublie)
    {
        $this->estPublie = $estPublie;
    }

    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}

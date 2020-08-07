<?php

namespace autoEcoleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moniteur
 *
 * @ORM\Table(name="moniteur")
 * @ORM\Entity(repositoryClass="autoEcoleBundle\Repository\MoniteurRepository")
 */
class Moniteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=8, nullable=true, unique=true)
     */
    private $cin;

    /**
     * @var int
     *
     * @ORM\Column(name="salaire", type="integer")
     */
    private $salaire;

    /**
     * @ORM\OneToMany(targetEntity="autoEcoleBundle\Entity\Entrainement", mappedBy="moniteur")
     */
    private $entrainements;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Moniteur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Moniteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return Moniteur
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set salaire
     *
     * @param integer $salaire
     *
     * @return Moniteur
     */
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;

        return $this;
    }

    /**
     * Get salaire
     *
     * @return int
     */
    public function getSalaire()
    {
        return $this->salaire;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entrainements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add entrainement
     *
     * @param \autoEcoleBundle\Entity\Entrainement $entrainement
     *
     * @return Moniteur
     */
    public function addEntrainement(\autoEcoleBundle\Entity\Entrainement $entrainement)
    {
        $this->entrainements[] = $entrainement;

        return $this;
    }

    /**
     * Remove entrainement
     *
     * @param \autoEcoleBundle\Entity\Entrainement $entrainement
     */
    public function removeEntrainement(\autoEcoleBundle\Entity\Entrainement $entrainement)
    {
        $this->entrainements->removeElement($entrainement);
    }

    /**
     * Get entrainements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntrainements()
    {
        return $this->entrainements;
    }
}

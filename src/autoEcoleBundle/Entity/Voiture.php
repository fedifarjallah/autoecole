<?php

namespace autoEcoleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="autoEcoleBundle\Repository\VoitureRepository")
 */
class Voiture
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
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255, unique=true)
     */
    private $modele;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity="autoEcoleBundle\Entity\Entrainement", mappedBy="voiture")
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
     * Set marque
     *
     * @param string $marque
     *
     * @return Voiture
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return Voiture
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Voiture
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Voiture
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
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
     * @return Voiture
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

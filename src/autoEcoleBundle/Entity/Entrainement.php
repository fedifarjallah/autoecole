<?php

namespace autoEcoleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * entrainement
 *
 * @ORM\Table(name="Entrainement")
 * @ORM\Entity(repositoryClass="autoEcoleBundle\Repository\EntrainementRepository")
 */
class Entrainement
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\ManyToOne(targetEntity="autoEcoleBundle\Entity\Moniteur", inversedBy="entrainements")
     * @ORM\JoinColumn(name="moniteur", referencedColumnName="id")
     */
    private $moniteur;

    /**
     * @ORM\ManyToOne(targetEntity="autoEcoleBundle\Entity\User", inversedBy="entrainements")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="autoEcoleBundle\Entity\Voiture", inversedBy="entrainements")
     * @ORM\JoinColumn(name="voiture", referencedColumnName="id")
     */
    private $voiture;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreHeure", type="integer")
     */
    private $nombreHeure;


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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return entrainement
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return entrainement
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set nombreHeure
     *
     * @param integer $nombreHeure
     *
     * @return entrainement
     */
    public function setNombreHeure($nombreHeure)
    {
        $this->nombreHeure = $nombreHeure;

        return $this;
    }

    /**
     * Get nombreHeure
     *
     * @return int
     */
    public function getNombreHeure()
    {
        return $this->nombreHeure;
    }

    /**
     * Set moniteur
     *
     * @param \autoEcoleBundle\Entity\Moniteur $moniteur
     *
     * @return Entrainement
     */
    public function setMoniteur(\autoEcoleBundle\Entity\Moniteur $moniteur = null)
    {
        $this->moniteur = $moniteur;

        return $this;
    }

    /**
     * Get moniteur
     *
     * @return \autoEcoleBundle\Entity\Moniteur
     */
    public function getMoniteur()
    {
        return $this->moniteur;
    }

    /**
     * Set user
     *
     * @param \autoEcoleBundle\Entity\User $user
     *
     * @return Entrainement
     */
    public function setUser(\autoEcoleBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \autoEcoleBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set voiture
     *
     * @param \autoEcoleBundle\Entity\Voiture $voiture
     *
     * @return Entrainement
     */
    public function setVoiture(\autoEcoleBundle\Entity\Voiture $voiture = null)
    {
        $this->voiture = $voiture;

        return $this;
    }

    /**
     * Get voiture
     *
     * @return \autoEcoleBundle\Entity\Voiture
     */
    public function getVoiture()
    {
        return $this->voiture;
    }
}

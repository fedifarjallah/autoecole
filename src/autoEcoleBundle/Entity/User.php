<?php

namespace autoEcoleBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="autoEcoleBundle\Entity\Entrainement", mappedBy="user")
     */
    private $entrainements;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add entrainement
     *
     * @param \autoEcoleBundle\Entity\Entrainement $entrainement
     *
     * @return User
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

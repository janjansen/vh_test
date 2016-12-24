<?php
/**
 * Created by PhpStorm.
 * User: rosomkin
 * Date: 24.12.16
 * Time: 13:33
 */

namespace AppBundle\Entity;

use AppBundle\Entity\PatientDisease;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="tb_disease",
 *     indexes={@ORM\Index(name="name_idx", columns={"icd"})})
 */
class Disease
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    protected $icd;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PatientDisease", mappedBy="disease")
     */
    protected $patientDisease;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->patientDisease = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set icd
     *
     * @param string $icd
     *
     * @return Disease
     */
    public function setIcd($icd)
    {
        $this->icd = $icd;

        return $this;
    }

    /**
     * Get icd
     *
     * @return string
     */
    public function getIcd()
    {
        return $this->icd;
    }

    /**
     * Add patientDisease
     *
     * @param PatientDisease $patientDisease
     *
     * @return Disease
     */
    public function addPatientDisease(PatientDisease $patientDisease)
    {
        $this->patientDisease[] = $patientDisease;

        return $this;
    }

    /**
     * Remove patientDisease
     *
     * @param PatientDisease $patientDisease
     */
    public function removePatientDisease(PatientDisease $patientDisease)
    {
        $this->patientDisease->removeElement($patientDisease);
    }

    /**
     * Get patientDisease
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatientDisease()
    {
        return $this->patientDisease;
    }
}

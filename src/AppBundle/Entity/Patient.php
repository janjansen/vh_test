<?php
/**
 * Created by PhpStorm.
 * User: rosomkin
 * Date: 24.12.16
 * Time: 13:30
 */

namespace AppBundle\Entity;

use AppBundle\Entity\PatientDisease;
use AppBundle\Entity\PatientDrug;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PatientRepository")
 * @ORM\Table(
 *     name="tb_patient",
 *     indexes={@ORM\Index(name="name_idx", columns={"name"})})
 */
class Patient
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    protected $medrecId;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PatientDisease", mappedBy="patient")
     */
    protected $patientDisease;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PatientDrug", mappedBy="patient")
     */
    protected $patientDrugs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->patientDisease = new ArrayCollection();
        $this->patientDrugs = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Patient
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set medrecId
     *
     * @param integer $medrecId
     *
     * @return Patient
     */
    public function setMedrecId($medrecId)
    {
        $this->medrecId = $medrecId;

        return $this;
    }

    /**
     * Get medrecId
     *
     * @return integer
     */
    public function getMedrecId()
    {
        return $this->medrecId;
    }

    /**
     * Add patientDisease
     *
     * @param PatientDisease $patientDisease
     *
     * @return Patient
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

    /**
     * Add patientDrug
     *
     * @param PatientDrug $patientDrug
     *
     * @return Patient
     */
    public function addPatientDrug(PatientDrug $patientDrug)
    {
        $this->patientDrugs[] = $patientDrug;

        return $this;
    }

    /**
     * Remove patientDrug
     *
     * @param PatientDrug $patientDrug
     */
    public function removePatientDrug(PatientDrug $patientDrug)
    {
        $this->patientDrugs->removeElement($patientDrug);
    }

    /**
     * Get patientDrugs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatientDrugs()
    {
        return $this->patientDrugs;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: rosomkin
 * Date: 24.12.16
 * Time: 13:43
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Drug;
use AppBundle\Entity\Patient;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tb_patient_drug")
 */
class PatientDrug
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Patient", inversedBy="patientDrugs")
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id", nullable=false)
     */
    protected $patient;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Drug", inversedBy="patientDrugs")
     * @ORM\JoinColumn(name="drug_id", referencedColumnName="id", nullable=false)
     */
    protected $drug;

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
     * Set patient
     *
     * @param Patient $patient
     *
     * @return PatientDrug
     */
    public function setPatient(Patient $patient)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return Patient
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * Set drug
     *
     * @param Drug $drug
     *
     * @return PatientDrug
     */
    public function setDrug(Drug $drug)
    {
        $this->drug = $drug;

        return $this;
    }

    /**
     * Get drug
     *
     * @return Drug
     */
    public function getDrug()
    {
        return $this->drug;
    }
}

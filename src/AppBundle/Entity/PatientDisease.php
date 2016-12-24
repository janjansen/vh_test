<?php
/**
 * Created by PhpStorm.
 * User: rosomkin
 * Date: 24.12.16
 * Time: 13:44
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Disease;
use AppBundle\Entity\Patient;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="tb_patient_disease",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="patient_disease_unique", columns={"patient_id", "disease_id"})}
 * )
 */
class PatientDisease
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Patient", inversedBy="patientDisease")
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id", nullable=false)
     */
    protected $patient;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Disease", inversedBy="patientDisease")
     * @ORM\JoinColumn(name="disease_id", referencedColumnName="id", nullable=false)
     */
    protected $disease;

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
     * @return PatientDisease
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
     * Set disease
     *
     * @param Disease $disease
     *
     * @return PatientDisease
     */
    public function setDisease(Disease $disease)
    {
        $this->disease = $disease;

        return $this;
    }

    /**
     * Get disease
     *
     * @return Disease
     */
    public function getDisease()
    {
        return $this->disease;
    }
}

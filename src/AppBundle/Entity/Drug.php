<?php
/**
 * Created by PhpStorm.
 * User: rosomkin
 * Date: 24.12.16
 * Time: 13:29
 */

namespace AppBundle\Entity;

use AppBundle\Entity\PatientDrug;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="tb_drug",
 *     indexes={@ORM\Index(name="name_idx", columns={"ndc"})})
 */
class Drug
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
    protected $ndc;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PatientDrug", mappedBy="drug")
     */
    protected $patientDrugs;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set ndc
     *
     * @param string $ndc
     *
     * @return Drug
     */
    public function setNdc($ndc)
    {
        $this->ndc = $ndc;

        return $this;
    }

    /**
     * Get ndc
     *
     * @return string
     */
    public function getNdc()
    {
        return $this->ndc;
    }

    /**
     * Add patientDrug
     *
     * @param PatientDrug $patientDrug
     *
     * @return Drug
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

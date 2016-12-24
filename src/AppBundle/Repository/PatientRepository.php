<?php
/**
 * Created by PhpStorm.
 * User: rosomkin
 * Date: 24.12.16
 * Time: 14:58
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use PDO;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class PatientRepository
 * @package AppBundle\Repository
 */
class PatientRepository extends EntityRepository
{

    /**
     * @param $search
     * @param int $offset
     * @param int $limit
     * @return Paginator
     */
    public function findPatientsWithOneOrMoreDrugs($search, $offset = 0, $limit = 10)
    {
        $dql = <<<DQL
            SELECT p 
            FROM AppBundle:Patient p
            LEFT JOIN p.patientDrugs pd
            WHERE p.name LIKE :search AND pd.id IS NOT NULL
            ORDER BY p.id ASC
DQL;

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('search', $search . '%');
        $query->setMaxResults($limit);
        $query->setFirstResult($offset);
        $results = new Paginator($query, $fetchJoin = true);

        return $results;
    }

    /**
     * @param $search
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function findPatientsWithOneOrMoreDrugsNoORM($search, $offset = 0, $limit = 10)
    {
        $q = <<<RAW_SQL
            SELECT * 
            FROM tb_patient p 
            WHERE 
                name LIKE :search
                AND EXISTS(
                    SELECT 1 FROM tb_patient_drug pd WHERE pd.patient_id = p.id
                )
            ORDER BY p.id ASC
            LIMIT :limit
            OFFSET :offset
RAW_SQL;

        $stmt = $this->getEntityManager()->getConnection()->prepare($q);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':search', $search . '%');
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161224135024 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('INSERT INTO tb_patient (medrec_id, name) SELECT DISTINCT MEDREC_ID, PATIENT_NAME FROM tb_source;');
        $this->addSql('INSERT INTO tb_disease (icd) SELECT DISTINCT ICD FROM tb_source;');
        $this->addSql('INSERT INTO tb_drug (ndc) SELECT DISTINCT NDC FROM tb_rel;');
        $q = <<<RAW_SQL
                    INSERT INTO tb_patient_disease (patient_id, disease_id) SELECT DISTINCT p.id, d.id
                                                                FROM tb_patient p
                                                                  JOIN tb_source s ON p.medrec_id = s.MEDREC_ID
                                                                  JOIN tb_disease d ON d.icd = s.ICD;
RAW_SQL;
        $this->addSql($q);
        $q = <<<RAW_SQL
                    INSERT INTO tb_patient_drug (patient_id, drug_id) SELECT p.id, d.id
                                                          FROM tb_patient p
                                                            JOIN tb_rel r ON p.medrec_id = r.MEDREC_ID
                                                            JOIN tb_drug d ON d.ndc = r.NDC;
RAW_SQL;

        $this->addSql($q);

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

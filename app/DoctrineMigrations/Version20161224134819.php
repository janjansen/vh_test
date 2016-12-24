<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161224134819 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tb_disease (id INT AUTO_INCREMENT NOT NULL, icd VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_70ECB063BC48B498 (icd), INDEX name_idx (icd), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_drug (id INT AUTO_INCREMENT NOT NULL, ndc VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_189B782F6822A179 (ndc), INDEX name_idx (ndc), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_patient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, medrec_id INT NOT NULL, UNIQUE INDEX UNIQ_650D0D49B7CA44C (medrec_id), INDEX name_idx (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_patient_disease (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, disease_id INT NOT NULL, INDEX IDX_C13AD8596B899279 (patient_id), INDEX IDX_C13AD859D8355341 (disease_id), UNIQUE INDEX patient_disease_unique (patient_id, disease_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_patient_drug (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, drug_id INT NOT NULL, INDEX IDX_A915E4716B899279 (patient_id), INDEX IDX_A915E471AABCA765 (drug_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tb_patient_disease ADD CONSTRAINT FK_C13AD8596B899279 FOREIGN KEY (patient_id) REFERENCES tb_patient (id)');
        $this->addSql('ALTER TABLE tb_patient_disease ADD CONSTRAINT FK_C13AD859D8355341 FOREIGN KEY (disease_id) REFERENCES tb_disease (id)');
        $this->addSql('ALTER TABLE tb_patient_drug ADD CONSTRAINT FK_A915E4716B899279 FOREIGN KEY (patient_id) REFERENCES tb_patient (id)');
        $this->addSql('ALTER TABLE tb_patient_drug ADD CONSTRAINT FK_A915E471AABCA765 FOREIGN KEY (drug_id) REFERENCES tb_drug (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tb_patient_disease DROP FOREIGN KEY FK_C13AD859D8355341');
        $this->addSql('ALTER TABLE tb_patient_drug DROP FOREIGN KEY FK_A915E471AABCA765');
        $this->addSql('ALTER TABLE tb_patient_disease DROP FOREIGN KEY FK_C13AD8596B899279');
        $this->addSql('ALTER TABLE tb_patient_drug DROP FOREIGN KEY FK_A915E4716B899279');
        $this->addSql('DROP TABLE tb_disease');
        $this->addSql('DROP TABLE tb_drug');
        $this->addSql('DROP TABLE tb_patient');
        $this->addSql('DROP TABLE tb_patient_disease');
        $this->addSql('DROP TABLE tb_patient_drug');
    }
}

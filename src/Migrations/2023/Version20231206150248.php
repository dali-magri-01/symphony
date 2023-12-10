<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206150248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE journal_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE monnaie_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE projet_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE journal (id NUMBER(10) NOT NULL, societe_id NUMBER(10) DEFAULT NULL NULL, monnaie_id NUMBER(10) DEFAULT NULL NULL, compte_id NUMBER(10) DEFAULT NULL NULL, jl_code VARCHAR2(20) NOT NULL, jl_lib VARCHAR2(255) NOT NULL, mois_exer VARCHAR2(20) DEFAULT NULL NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C1A7E74DFCF77503 ON journal (societe_id)');
        $this->addSql('CREATE INDEX IDX_C1A7E74D98D3FE22 ON journal (monnaie_id)');
        $this->addSql('CREATE INDEX IDX_C1A7E74DF2C56620 ON journal (compte_id)');
        $this->addSql('CREATE TABLE monnaie (id NUMBER(10) NOT NULL, societe_id NUMBER(10) DEFAULT NULL NULL, mon_code VARCHAR2(255) NOT NULL, mon_lib VARCHAR2(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B3A6E2E6FCF77503 ON monnaie (societe_id)');
        $this->addSql('CREATE TABLE projet (id NUMBER(10) NOT NULL, societe_id NUMBER(10) DEFAULT NULL NULL, pr_code VARCHAR2(20) NOT NULL, pr_lib VARCHAR2(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_50159CA9FCF77503 ON projet (societe_id)');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74DFCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74D98D3FE22 FOREIGN KEY (monnaie_id) REFERENCES monnaie (id)');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74DF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE monnaie ADD CONSTRAINT FK_B3A6E2E6FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE journal_id_seq');
        $this->addSql('DROP SEQUENCE monnaie_id_seq');
        $this->addSql('DROP SEQUENCE projet_id_seq');
        $this->addSql('ALTER TABLE journal DROP CONSTRAINT FK_C1A7E74DFCF77503');
        $this->addSql('ALTER TABLE journal DROP CONSTRAINT FK_C1A7E74D98D3FE22');
        $this->addSql('ALTER TABLE journal DROP CONSTRAINT FK_C1A7E74DF2C56620');
        $this->addSql('ALTER TABLE monnaie DROP CONSTRAINT FK_B3A6E2E6FCF77503');
        $this->addSql('ALTER TABLE projet DROP CONSTRAINT FK_50159CA9FCF77503');
        $this->addSql('DROP TABLE journal');
        $this->addSql('DROP TABLE monnaie');
        $this->addSql('DROP TABLE projet');
    }
}

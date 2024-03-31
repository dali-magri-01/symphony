<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321114558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ecritures (id NUMBER(10) NOT NULL, numpiece_id NUMBER(10) DEFAULT NULL NULL, tier_id NUMBER(10) DEFAULT NULL NULL, compte_id NUMBER(10) DEFAULT NULL NULL, cp_code VARCHAR2(255) NOT NULL, libelle VARCHAR2(255) NOT NULL, sens VARCHAR2(255) DEFAULT NULL NULL, montant DOUBLE PRECISION DEFAULT NULL NULL, type VARCHAR2(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2CD5FD767544343C ON ecritures (numpiece_id)');
        $this->addSql('CREATE INDEX IDX_2CD5FD76A354F9DC ON ecritures (tier_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2CD5FD76F2C56620 ON ecritures (compte_id)');
        $this->addSql('CREATE TABLE piece_comptable (id NUMBER(10) NOT NULL, jl_code_id NUMBER(10) DEFAULT NULL NULL, monnaie_id NUMBER(10) DEFAULT NULL NULL, journal_id NUMBER(10) DEFAULT NULL NULL, datepiece DATE DEFAULT NULL NULL, libelle VARCHAR2(255) DEFAULT NULL NULL, tauxchange VARCHAR2(255) DEFAULT NULL NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6BE5CEE1A9A84E7C ON piece_comptable (jl_code_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6BE5CEE198D3FE22 ON piece_comptable (monnaie_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6BE5CEE1478E8802 ON piece_comptable (journal_id)');
        $this->addSql('ALTER TABLE ecritures ADD CONSTRAINT FK_2CD5FD767544343C FOREIGN KEY (numpiece_id) REFERENCES piece_comptable (id)');
        $this->addSql('ALTER TABLE ecritures ADD CONSTRAINT FK_2CD5FD76A354F9DC FOREIGN KEY (tier_id) REFERENCES tiers (id)');
        $this->addSql('ALTER TABLE ecritures ADD CONSTRAINT FK_2CD5FD76F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE piece_comptable ADD CONSTRAINT FK_6BE5CEE1A9A84E7C FOREIGN KEY (jl_code_id) REFERENCES journal (id)');
        $this->addSql('ALTER TABLE piece_comptable ADD CONSTRAINT FK_6BE5CEE198D3FE22 FOREIGN KEY (monnaie_id) REFERENCES monnaie (id)');
        $this->addSql('ALTER TABLE piece_comptable ADD CONSTRAINT FK_6BE5CEE1478E8802 FOREIGN KEY (journal_id) REFERENCES journal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecritures DROP CONSTRAINT FK_2CD5FD767544343C');
        $this->addSql('ALTER TABLE ecritures DROP CONSTRAINT FK_2CD5FD76A354F9DC');
        $this->addSql('ALTER TABLE ecritures DROP CONSTRAINT FK_2CD5FD76F2C56620');
        $this->addSql('ALTER TABLE piece_comptable DROP CONSTRAINT FK_6BE5CEE1A9A84E7C');
        $this->addSql('ALTER TABLE piece_comptable DROP CONSTRAINT FK_6BE5CEE198D3FE22');
        $this->addSql('ALTER TABLE piece_comptable DROP CONSTRAINT FK_6BE5CEE1478E8802');
        $this->addSql('DROP TABLE ecritures');
        $this->addSql('DROP TABLE piece_comptable');
    }
}

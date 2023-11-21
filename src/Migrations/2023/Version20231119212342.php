<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231119212342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compte (id NUMBER(10) NOT NULL, societe_id NUMBER(10) NOT NULL, cp_type_tiers_id NUMBER(10) NOT NULL, cp_code VARCHAR2(255) NOT NULL, cp_lib VARCHAR2(255) DEFAULT NULL NULL, cp_sens VARCHAR2(1) DEFAULT \'B\', cp_actif VARCHAR2(1)  DEFAULT \'O\', cp_traduction VARCHAR2(255) DEFAULT NULL NULL, cp_analytique VARCHAR2(255) DEFAULT \'N\', created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFF65260C0023359 ON compte (cp_code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFF65260FCF77503 ON compte (societe_id)');
        $this->addSql('CREATE INDEX IDX_CFF6526021CDC1BA ON compte (cp_type_tiers_id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526021CDC1BA FOREIGN KEY (cp_type_tiers_id) REFERENCES type_tiers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte DROP CONSTRAINT FK_CFF65260FCF77503');
        $this->addSql('ALTER TABLE compte DROP CONSTRAINT FK_CFF6526021CDC1BA');
        $this->addSql('DROP TABLE compte');
    }
}

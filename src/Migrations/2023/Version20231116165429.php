<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116165429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE type_tiers_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE type_tiers (id NUMBER(10) NOT NULL, societe_id NUMBER(10) NOT NULL, tt_code VARCHAR2(250) DEFAULT NULL NULL, tt_lib VARCHAR2(250) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_184BBC55F9EAD30F ON type_tiers (tt_code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_184BBC55FCF77503 ON type_tiers (societe_id)');
        $this->addSql('ALTER TABLE type_tiers ADD CONSTRAINT FK_184BBC55FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE type_tiers_id_seq');
        $this->addSql('ALTER TABLE type_tiers DROP CONSTRAINT FK_184BBC55FCF77503');
        $this->addSql('DROP TABLE type_tiers');
    }
}

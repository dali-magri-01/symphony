<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324140248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE type_tier_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE type_tires_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE type_tier (id NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_tires (id NUMBER(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE TYPE_TIERS ADD (societe_id NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE TYPE_TIERS ADD CONSTRAINT FK_184BBC55FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('CREATE INDEX IDX_184BBC55FCF77503 ON TYPE_TIERS (societe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE type_tier_id_seq');
        $this->addSql('DROP SEQUENCE type_tires_id_seq');
        $this->addSql('DROP TABLE type_tier');
        $this->addSql('DROP TABLE type_tires');
        $this->addSql('ALTER TABLE type_tiers DROP CONSTRAINT FK_184BBC55FCF77503');
        $this->addSql('DROP INDEX IDX_184BBC55FCF77503');
        $this->addSql('ALTER TABLE type_tiers DROP (societe_id)');
    }
}

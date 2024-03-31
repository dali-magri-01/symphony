<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324133148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE SOCIETE ADD (type_tier_id NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE SOCIETE ADD CONSTRAINT FK_19653DBD8B759629 FOREIGN KEY (type_tier_id) REFERENCES type_tiers (id)');
        $this->addSql('CREATE INDEX IDX_19653DBD8B759629 ON SOCIETE (type_tier_id)');
        $this->addSql('ALTER TABLE TYPE_TIERS DROP CONSTRAINT FK_184BBC55FCF77503');
        $this->addSql('DROP INDEX uniq_184bbc55fcf77503');
        $this->addSql('ALTER TABLE TYPE_TIERS DROP (SOCIETE_ID)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_tiers ADD (SOCIETE_ID NUMBER(10) NOT NULL)');
        $this->addSql('ALTER TABLE type_tiers ADD CONSTRAINT FK_184BBC55FCF77503 FOREIGN KEY (SOCIETE_ID) REFERENCES SOCIETE (ID)');
        $this->addSql('CREATE UNIQUE INDEX uniq_184bbc55fcf77503 ON type_tiers (SOCIETE_ID)');
        $this->addSql('ALTER TABLE societe DROP CONSTRAINT FK_19653DBD8B759629');
        $this->addSql('DROP INDEX IDX_19653DBD8B759629');
        $this->addSql('ALTER TABLE societe DROP (type_tier_id)');
    }
}

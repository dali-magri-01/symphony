<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324140607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE JOURNAL ADD (societe_id NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE JOURNAL ADD CONSTRAINT FK_C1A7E74DFCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('CREATE INDEX IDX_C1A7E74DFCF77503 ON JOURNAL (societe_id)');
        $this->addSql('ALTER TABLE SOCIETE DROP CONSTRAINT FK_19653DBD478E8802');
        $this->addSql('DROP INDEX idx_19653dbd478e8802');
        $this->addSql('ALTER TABLE SOCIETE DROP (JOURNAL_ID)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE journal DROP CONSTRAINT FK_C1A7E74DFCF77503');
        $this->addSql('DROP INDEX IDX_C1A7E74DFCF77503');
        $this->addSql('ALTER TABLE journal DROP (societe_id)');
        $this->addSql('ALTER TABLE societe ADD (JOURNAL_ID NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBD478E8802 FOREIGN KEY (JOURNAL_ID) REFERENCES JOURNAL (ID)');
        $this->addSql('CREATE INDEX idx_19653dbd478e8802 ON societe (JOURNAL_ID)');
    }
}

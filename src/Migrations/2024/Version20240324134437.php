<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324134437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE JOURNAL DROP CONSTRAINT FK_C1A7E74DFCF77503');
        $this->addSql('DROP INDEX idx_c1a7e74dfcf77503');
        $this->addSql('ALTER TABLE JOURNAL DROP (SOCIETE_ID)');
        $this->addSql('ALTER TABLE SOCIETE ADD (journal_id NUMBER(10) DEFAULT NULL NULL, compte_id NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE SOCIETE ADD CONSTRAINT FK_19653DBD478E8802 FOREIGN KEY (journal_id) REFERENCES journal (id)');
        $this->addSql('ALTER TABLE SOCIETE ADD CONSTRAINT FK_19653DBDF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_19653DBD478E8802 ON SOCIETE (journal_id)');
        $this->addSql('CREATE INDEX IDX_19653DBDF2C56620 ON SOCIETE (compte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe DROP CONSTRAINT FK_19653DBD478E8802');
        $this->addSql('ALTER TABLE societe DROP CONSTRAINT FK_19653DBDF2C56620');
        $this->addSql('DROP INDEX IDX_19653DBD478E8802');
        $this->addSql('DROP INDEX IDX_19653DBDF2C56620');
        $this->addSql('ALTER TABLE societe DROP (journal_id, compte_id)');
        $this->addSql('ALTER TABLE journal ADD (SOCIETE_ID NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74DFCF77503 FOREIGN KEY (SOCIETE_ID) REFERENCES SOCIETE (ID)');
        $this->addSql('CREATE INDEX idx_c1a7e74dfcf77503 ON journal (SOCIETE_ID)');
    }
}

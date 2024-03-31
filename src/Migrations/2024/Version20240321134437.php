<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321134437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ECRITURES_COMPTE DROP CONSTRAINT FK_BB80BA9A61966855');
        $this->addSql('ALTER TABLE ECRITURES_COMPTE DROP CONSTRAINT FK_BB80BA9AF2C56620');
        $this->addSql('DROP TABLE ECRITURES_COMPTE');
        $this->addSql('ALTER TABLE ECRITURES ADD (compte_id NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ECRITURES ADD CONSTRAINT FK_2CD5FD76F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_2CD5FD76F2C56620 ON ECRITURES (compte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ECRITURES_COMPTE (ECRITURES_ID NUMBER(10) NOT NULL, COMPTE_ID NUMBER(10) NOT NULL, PRIMARY KEY(ECRITURES_ID, COMPTE_ID))');
        $this->addSql('CREATE INDEX idx_bb80ba9a61966855 ON ECRITURES_COMPTE (ECRITURES_ID)');
        $this->addSql('CREATE INDEX idx_bb80ba9af2c56620 ON ECRITURES_COMPTE (COMPTE_ID)');
        $this->addSql('ALTER TABLE ECRITURES_COMPTE ADD CONSTRAINT FK_BB80BA9A61966855 FOREIGN KEY (ECRITURES_ID) REFERENCES ECRITURES (ID) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ECRITURES_COMPTE ADD CONSTRAINT FK_BB80BA9AF2C56620 FOREIGN KEY (COMPTE_ID) REFERENCES COMPTE (ID) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ecritures DROP CONSTRAINT FK_2CD5FD76F2C56620');
        $this->addSql('DROP INDEX IDX_2CD5FD76F2C56620');
        $this->addSql('ALTER TABLE ecritures DROP (compte_id)');
    }
}

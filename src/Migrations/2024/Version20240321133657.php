<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321133657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ecritures_compte (ecritures_id NUMBER(10) NOT NULL, compte_id NUMBER(10) NOT NULL, PRIMARY KEY(ecritures_id, compte_id))');
        $this->addSql('CREATE INDEX IDX_BB80BA9A61966855 ON ecritures_compte (ecritures_id)');
        $this->addSql('CREATE INDEX IDX_BB80BA9AF2C56620 ON ecritures_compte (compte_id)');
        $this->addSql('ALTER TABLE ecritures_compte ADD CONSTRAINT FK_BB80BA9A61966855 FOREIGN KEY (ecritures_id) REFERENCES ecritures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ecritures_compte ADD CONSTRAINT FK_BB80BA9AF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ECRITURES DROP CONSTRAINT FK_2CD5FD76F2C56620');
        $this->addSql('DROP INDEX uniq_2cd5fd76f2c56620');
        $this->addSql('ALTER TABLE ECRITURES DROP (COMPTE_ID)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecritures_compte DROP CONSTRAINT FK_BB80BA9A61966855');
        $this->addSql('ALTER TABLE ecritures_compte DROP CONSTRAINT FK_BB80BA9AF2C56620');
        $this->addSql('DROP TABLE ecritures_compte');
        $this->addSql('ALTER TABLE ecritures ADD (COMPTE_ID NUMBER(10) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE ecritures ADD CONSTRAINT FK_2CD5FD76F2C56620 FOREIGN KEY (COMPTE_ID) REFERENCES COMPTE (ID)');
        $this->addSql('CREATE UNIQUE INDEX uniq_2cd5fd76f2c56620 ON ecritures (COMPTE_ID)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231015164032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function preUp(Schema $schema): void
    {
        parent::preUp($schema);

        $this->addSql("ALTER session SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS' NLS_TIME_FORMAT = 'HH24:MI:SS' NLS_TIMESTAMP_FORMAT = 'YYYY-MM-DD HH24:MI:SS' NLS_TIMESTAMP_TZ_FORMAT = 'YYYY-MM-DD HH24:MI:SS TZH:TZM' NLS_TIME_TZ_FORMAT = 'HH24:MI:SS TZH:TZM'");
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE societe_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE societe (id NUMBER(10) NOT NULL, libelle VARCHAR2(200) DEFAULT NULL NULL, mat_fisc VARCHAR2(40) DEFAULT NULL NULL, rue VARCHAR2(100) DEFAULT NULL NULL, ville VARCHAR2(100) DEFAULT NULL NULL, pays VARCHAR2(100) DEFAULT NULL NULL, rc VARCHAR2(40) DEFAULT NULL NULL, actif NUMBER(1) NOT NULL, create_at TIMESTAMP(0) DEFAULT NULL NULL, update_at TIMESTAMP(0) DEFAULT NULL NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE societe_id_seq');
        $this->addSql('DROP TABLE societe');
    }
}

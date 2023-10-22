<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231022123959 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE "user_id_seq" START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE "user" (id NUMBER(10) NOT NULL, email VARCHAR2(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR2(255) NOT NULL, PRIMARY KEY(id), is_verified NUMBER(1) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".roles IS \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE SOCIETE MODIFY (actif NUMBER(1) DEFAULT NULL NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE "user_id_seq"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('ALTER TABLE societe MODIFY (ACTIF NUMBER(1) NOT NULL)');
        $this->addSql('ALTER TABLE societe RENAME COLUMN matricule_fiscale TO MAT_FISC');
    }
}

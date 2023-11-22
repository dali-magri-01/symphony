<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122090318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE MESSENGER_MESSAGES_SEQ');
        $this->addSql('CREATE SEQUENCE compte_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE tiers_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE tiers (id NUMBER(10) NOT NULL, tr_type_tiers_id NUMBER(10) NOT NULL, societe_id NUMBER(10) NOT NULL, tr_code VARCHAR2(20) NOT NULL, tr_lib VARCHAR2(20) NOT NULL, tr_adresse VARCHAR2(255) DEFAULT NULL NULL, tr_type_ident VARCHAR2(20) DEFAULT NULL NULL, tr_ident VARCHAR2(255) DEFAULT NULL NULL, tr_activite VARCHAR2(255) DEFAULT NULL NULL, tr_email VARCHAR2(255) DEFAULT NULL NULL, created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_16473BA22FB33012 ON tiers (tr_code)');
        $this->addSql('CREATE INDEX IDX_16473BA29295B6C0 ON tiers (tr_type_tiers_id)');
        $this->addSql('ALTER TABLE tiers ADD CONSTRAINT FK_16473BA29295B6C0 FOREIGN KEY (tr_type_tiers_id) REFERENCES type_tiers (id)');
        $this->addSql('ALTER TABLE tiers ADD CONSTRAINT FK_16473BA2FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE TYPE_TIERS ADD (created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_16473BA2FCF77503 ON TIERS (societe_id)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE compte_id_seq');
        $this->addSql('DROP SEQUENCE tiers_id_seq');
        $this->addSql('CREATE SEQUENCE MESSENGER_MESSAGES_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('ALTER TABLE tiers DROP CONSTRAINT FK_16473BA29295B6C0');
        $this->addSql('ALTER TABLE tiers DROP CONSTRAINT FK_16473BA2FCF77503');
        $this->addSql('DROP TABLE tiers');
        $this->addSql('ALTER TABLE type_tiers DROP (created_at, updated_at)');
        $this->addSql('DROP INDEX IDX_16473BA2FCF77503');

    }
}

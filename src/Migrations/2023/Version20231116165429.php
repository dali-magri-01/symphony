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
        $this->addSql('CREATE TABLE type_tiers (id NUMBER(10) NOT NULL, societe_id NUMBER(10) NOT NULL, tt_code VARCHAR2(250) DEFAULT NULL, tt_lib VARCHAR2(250) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_184BBC55FCF77503 ON type_tiers (societe_id)');
        $this->addSql('ALTER TABLE type_tiers ADD CONSTRAINT FK_184BBC55FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE DEVISE DROP (CREATED_AT, UPDATED_AT)');
        $this->addSql('ALTER TABLE MENU ADD CONSTRAINT FK_7D053A93727ACA70 FOREIGN KEY (parent_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE PAYS DROP (CREATED_AT, UPDATED_AT)');
        $this->addSql('ALTER TABLE SOCIETE ADD CONSTRAINT FK_19653DBDA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE SOCIETE ADD CONSTRAINT FK_19653DBDF4445056 FOREIGN KEY (devise_id) REFERENCES devise (id)');
        $this->addSql('ALTER TABLE MESSENGER_MESSAGES MODIFY (created_at TIMESTAMP(0) DEFAULT NULL, available_at TIMESTAMP(0) DEFAULT NULL, delivered_at TIMESTAMP(0) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON MESSENGER_MESSAGES (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON MESSENGER_MESSAGES (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON MESSENGER_MESSAGES (delivered_at)');
        $this->addSql('DROP INDEX uniq_184bbc55e8035551');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_184BBC55F9EAD30F ON TYPE_TIERS (tt_code)');


    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE type_tiers_id_seq');
        $this->addSql('ALTER TABLE type_tiers DROP CONSTRAINT FK_184BBC55FCF77503');
        $this->addSql('DROP TABLE type_tiers');
        $this->addSql('DROP INDEX IDX_75EA56E0FB7336F0');
        $this->addSql('DROP INDEX IDX_75EA56E0E3BD61CE');
        $this->addSql('DROP INDEX IDX_75EA56E016BA31DB');
        $this->addSql('ALTER TABLE messenger_messages MODIFY (CREATED_AT TIMESTAMP(0) DEFAULT NULL, AVAILABLE_AT TIMESTAMP(0) DEFAULT NULL, DELIVERED_AT TIMESTAMP(0) DEFAULT NULL)');
        $this->addSql('ALTER TABLE devise ADD (CREATED_AT TIMESTAMP(0) NOT NULL, UPDATED_AT TIMESTAMP(0) NOT NULL)');
        $this->addSql('ALTER TABLE societe DROP CONSTRAINT FK_19653DBDA6E44244');
        $this->addSql('ALTER TABLE societe DROP CONSTRAINT FK_19653DBDF4445056');
        $this->addSql('ALTER TABLE pays ADD (CREATED_AT TIMESTAMP(0) NOT NULL, UPDATED_AT TIMESTAMP(0) NOT NULL)');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A93727ACA70');
        $this->addSql('DROP INDEX UNIQ_184BBC55F9EAD30F');
        $this->addSql('DROP INDEX UNIQ_184BBC55FCF77503');
        $this->addSql('CREATE UNIQUE INDEX uniq_184bbc55e8035551 ON type_tiers (TT_LIB)');






    }
}

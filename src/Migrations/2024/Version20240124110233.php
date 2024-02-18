<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124110233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE compte_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE devise_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE journal_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE menu_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE monnaie_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE pays_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE projet_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE societe_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE tiers_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE type_tiers_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE compte (id NUMBER(10) NOT NULL, societe_id NUMBER(10) NOT NULL, cp_type_tiers_id NUMBER(10) NOT NULL, cp_code VARCHAR2(255) NOT NULL, cp_lib VARCHAR2(255) DEFAULT NULL NULL, cp_sens VARCHAR2(1) DEFAULT \'B\' NULL, cp_actif VARCHAR2(1) DEFAULT \'O\' NULL, cp_traduction VARCHAR2(255) DEFAULT NULL NULL, cp_analytique VARCHAR2(255) DEFAULT \'N\' NULL, created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFF65260C0023359 ON compte (cp_code)');
        $this->addSql('CREATE INDEX IDX_CFF65260FCF77503 ON compte (societe_id)');
        $this->addSql('CREATE INDEX IDX_CFF6526021CDC1BA ON compte (cp_type_tiers_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_index_societe_compte ON compte (societe_id, cp_code)');
        $this->addSql('CREATE TABLE devise (id NUMBER(10) NOT NULL, code VARCHAR2(20) DEFAULT NULL NULL, status VARCHAR2(2) DEFAULT NULL NULL, created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE journal (id NUMBER(10) NOT NULL, societe_id NUMBER(10) DEFAULT NULL NULL, monnaie_id NUMBER(10) DEFAULT NULL NULL, compte_id NUMBER(10) DEFAULT NULL NULL, jl_code VARCHAR2(20) NOT NULL, jl_lib VARCHAR2(255) NOT NULL, mois_exer VARCHAR2(20) DEFAULT NULL NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C1A7E74DFCF77503 ON journal (societe_id)');
        $this->addSql('CREATE INDEX IDX_C1A7E74D98D3FE22 ON journal (monnaie_id)');
        $this->addSql('CREATE INDEX IDX_C1A7E74DF2C56620 ON journal (compte_id)');
        $this->addSql('CREATE TABLE menu (id NUMBER(10) NOT NULL, parent_id NUMBER(10) DEFAULT NULL NULL, name VARCHAR2(255) DEFAULT NULL NULL, ordre NUMBER(10) DEFAULT NULL NULL, link VARCHAR2(255) DEFAULT NULL NULL, created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7D053A93727ACA70 ON menu (parent_id)');
        $this->addSql('CREATE TABLE monnaie (id NUMBER(10) NOT NULL, societe_id NUMBER(10) DEFAULT NULL NULL, mon_code VARCHAR2(255) NOT NULL, mon_lib VARCHAR2(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B3A6E2E6FCF77503 ON monnaie (societe_id)');
        $this->addSql('CREATE TABLE pays (id NUMBER(10) NOT NULL, code VARCHAR2(10) DEFAULT NULL NULL, alpha2 VARCHAR2(10) NOT NULL, alpha3 VARCHAR2(10) NOT NULL, nom_en_gb VARCHAR2(100) DEFAULT NULL NULL, nom_fr_fr VARCHAR2(100) NOT NULL, created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE projet (id NUMBER(10) NOT NULL, societe_id NUMBER(10) DEFAULT NULL NULL, pr_code VARCHAR2(20) NOT NULL, pr_lib VARCHAR2(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_50159CA9FCF77503 ON projet (societe_id)');
        $this->addSql('CREATE TABLE societe (id NUMBER(10) NOT NULL, pays_id NUMBER(10) DEFAULT NULL NULL, devise_id NUMBER(10) DEFAULT NULL NULL, libelle VARCHAR2(255) DEFAULT NULL NULL, matricule_fiscale VARCHAR2(40) DEFAULT NULL NULL, rue VARCHAR2(255) DEFAULT NULL NULL, ville VARCHAR2(255) DEFAULT NULL NULL, rc VARCHAR2(40) DEFAULT NULL NULL, actif NUMBER(1) DEFAULT NULL NULL, code_postal NUMBER(10) DEFAULT NULL NULL, logo_filename VARCHAR2(255) DEFAULT NULL NULL, created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_19653DBDA6E44244 ON societe (pays_id)');
        $this->addSql('CREATE INDEX IDX_19653DBDF4445056 ON societe (devise_id)');
        $this->addSql('CREATE TABLE tiers (id NUMBER(10) NOT NULL, tr_type_tiers_id NUMBER(10) NOT NULL, societe_id NUMBER(10) NOT NULL, tr_code VARCHAR2(20) NOT NULL, tr_lib VARCHAR2(20) NOT NULL, tr_adresse VARCHAR2(255) DEFAULT NULL NULL, tr_type_ident VARCHAR2(20) DEFAULT NULL NULL, tr_ident VARCHAR2(255) DEFAULT NULL NULL, tr_activite VARCHAR2(255) DEFAULT NULL NULL, tr_email VARCHAR2(255) DEFAULT NULL NULL, created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_16473BA22FB33012 ON tiers (tr_code)');
        $this->addSql('CREATE INDEX IDX_16473BA29295B6C0 ON tiers (tr_type_tiers_id)');
        $this->addSql('CREATE INDEX IDX_16473BA2FCF77503 ON tiers (societe_id)');
        $this->addSql('CREATE TABLE type_tiers (id NUMBER(10) NOT NULL, societe_id NUMBER(10) NOT NULL, tt_code VARCHAR2(250) DEFAULT NULL NULL, tt_lib VARCHAR2(250) NOT NULL, created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_184BBC55F9EAD30F ON type_tiers (tt_code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_184BBC55FCF77503 ON type_tiers (societe_id)');
        $this->addSql('CREATE TABLE "user" (id NUMBER(10) NOT NULL, email VARCHAR2(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR2(255) NOT NULL, is_verified NUMBER(1) NOT NULL, created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".roles IS \'(DC2Type:json)\'');
        $this->addSql('CREATE TABLE messenger_messages (id NUMBER(20) NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR2(190) NOT NULL, created_at TIMESTAMP(0) NOT NULL, available_at TIMESTAMP(0) NOT NULL, delivered_at TIMESTAMP(0) DEFAULT NULL NULL, PRIMARY KEY(id))');
        $this->addSql('DECLARE
          constraints_Count NUMBER;
        BEGIN
          SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count
            FROM USER_CONSTRAINTS
           WHERE TABLE_NAME = \'MESSENGER_MESSAGES\'
             AND CONSTRAINT_TYPE = \'P\';
          IF constraints_Count = 0 OR constraints_Count = \'\' THEN
            EXECUTE IMMEDIATE \'ALTER TABLE MESSENGER_MESSAGES ADD CONSTRAINT MESSENGER_MESSAGES_AI_PK PRIMARY KEY (ID)\';
          END IF;
        END;');
        $this->addSql('CREATE SEQUENCE MESSENGER_MESSAGES_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TRIGGER MESSENGER_MESSAGES_AI_PK
           BEFORE INSERT
           ON MESSENGER_MESSAGES
           FOR EACH ROW
        DECLARE
           last_Sequence NUMBER;
           last_InsertID NUMBER;
        BEGIN
           IF (:NEW.ID IS NULL OR :NEW.ID = 0) THEN
              SELECT MESSENGER_MESSAGES_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           ELSE
              SELECT NVL(Last_Number, 0) INTO last_Sequence
                FROM User_Sequences
               WHERE Sequence_Name = \'MESSENGER_MESSAGES_SEQ\';
              SELECT :NEW.ID INTO last_InsertID FROM DUAL;
              WHILE (last_InsertID > last_Sequence) LOOP
                 SELECT MESSENGER_MESSAGES_SEQ.NEXTVAL INTO last_Sequence FROM DUAL;
              END LOOP;
              SELECT MESSENGER_MESSAGES_SEQ.NEXTVAL INTO last_Sequence FROM DUAL;
           END IF;
        END;');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526021CDC1BA FOREIGN KEY (cp_type_tiers_id) REFERENCES type_tiers (id)');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74DFCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74D98D3FE22 FOREIGN KEY (monnaie_id) REFERENCES monnaie (id)');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74DF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93727ACA70 FOREIGN KEY (parent_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE monnaie ADD CONSTRAINT FK_B3A6E2E6FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBDA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBDF4445056 FOREIGN KEY (devise_id) REFERENCES devise (id)');
        $this->addSql('ALTER TABLE tiers ADD CONSTRAINT FK_16473BA29295B6C0 FOREIGN KEY (tr_type_tiers_id) REFERENCES type_tiers (id)');
        $this->addSql('ALTER TABLE tiers ADD CONSTRAINT FK_16473BA2FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE type_tiers ADD CONSTRAINT FK_184BBC55FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE MENU ADD (icon VARCHAR2(255) NOT NULL, active NUMBER(1) DEFAULT 0 NOT  NULL)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE compte_id_seq');
        $this->addSql('DROP SEQUENCE devise_id_seq');
        $this->addSql('DROP SEQUENCE journal_id_seq');
        $this->addSql('DROP SEQUENCE menu_id_seq');
        $this->addSql('DROP SEQUENCE monnaie_id_seq');
        $this->addSql('DROP SEQUENCE pays_id_seq');
        $this->addSql('DROP SEQUENCE projet_id_seq');
        $this->addSql('DROP SEQUENCE societe_id_seq');
        $this->addSql('DROP SEQUENCE tiers_id_seq');
        $this->addSql('DROP SEQUENCE type_tiers_id_seq');
        $this->addSql('DROP SEQUENCE "user_id_seq"');
        $this->addSql('ALTER TABLE compte DROP CONSTRAINT FK_CFF65260FCF77503');
        $this->addSql('ALTER TABLE compte DROP CONSTRAINT FK_CFF6526021CDC1BA');
        $this->addSql('ALTER TABLE journal DROP CONSTRAINT FK_C1A7E74DFCF77503');
        $this->addSql('ALTER TABLE journal DROP CONSTRAINT FK_C1A7E74D98D3FE22');
        $this->addSql('ALTER TABLE journal DROP CONSTRAINT FK_C1A7E74DF2C56620');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A93727ACA70');
        $this->addSql('ALTER TABLE monnaie DROP CONSTRAINT FK_B3A6E2E6FCF77503');
        $this->addSql('ALTER TABLE projet DROP CONSTRAINT FK_50159CA9FCF77503');
        $this->addSql('ALTER TABLE societe DROP CONSTRAINT FK_19653DBDA6E44244');
        $this->addSql('ALTER TABLE societe DROP CONSTRAINT FK_19653DBDF4445056');
        $this->addSql('ALTER TABLE tiers DROP CONSTRAINT FK_16473BA29295B6C0');
        $this->addSql('ALTER TABLE tiers DROP CONSTRAINT FK_16473BA2FCF77503');
        $this->addSql('ALTER TABLE type_tiers DROP CONSTRAINT FK_184BBC55FCF77503');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE devise');
        $this->addSql('DROP TABLE journal');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE monnaie');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE societe');
        $this->addSql('DROP TABLE tiers');
        $this->addSql('DROP TABLE type_tiers');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE menu DROP (icon, active)');

    }
}

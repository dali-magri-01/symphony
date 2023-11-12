<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108210250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ext_translations (id NUMBER(10) NOT NULL, locale VARCHAR2(8) NOT NULL, object_class VARCHAR2(191) NOT NULL, field VARCHAR2(32) NOT NULL, foreign_key VARCHAR2(64) NOT NULL, content CLOB DEFAULT NULL NULL, PRIMARY KEY(id))');
        $this->addSql('DECLARE
          constraints_Count NUMBER;
        BEGIN
          SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count
            FROM USER_CONSTRAINTS
           WHERE TABLE_NAME = \'EXT_TRANSLATIONS\'
             AND CONSTRAINT_TYPE = \'P\';
          IF constraints_Count = 0 OR constraints_Count = \'\' THEN
            EXECUTE IMMEDIATE \'ALTER TABLE EXT_TRANSLATIONS ADD CONSTRAINT EXT_TRANSLATIONS_AI_PK PRIMARY KEY (ID)\';
          END IF;
        END;');
        $this->addSql('CREATE SEQUENCE EXT_TRANSLATIONS_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TRIGGER EXT_TRANSLATIONS_AI_PK
           BEFORE INSERT
           ON EXT_TRANSLATIONS
           FOR EACH ROW
        DECLARE
           last_Sequence NUMBER;
           last_InsertID NUMBER;
        BEGIN
           IF (:NEW.ID IS NULL OR :NEW.ID = 0) THEN
              SELECT EXT_TRANSLATIONS_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
           ELSE
              SELECT NVL(Last_Number, 0) INTO last_Sequence
                FROM User_Sequences
               WHERE Sequence_Name = \'EXT_TRANSLATIONS_SEQ\';
              SELECT :NEW.ID INTO last_InsertID FROM DUAL;
              WHILE (last_InsertID > last_Sequence) LOOP
                 SELECT EXT_TRANSLATIONS_SEQ.NEXTVAL INTO last_Sequence FROM DUAL;
              END LOOP;
              SELECT EXT_TRANSLATIONS_SEQ.NEXTVAL INTO last_Sequence FROM DUAL;
           END IF;
        END;');
        $this->addSql('CREATE INDEX translations_lookup_idx ON ext_translations (locale, object_class, foreign_key)');

        //ORA-00972: l'identificateur est trop long
        //$this->addSql('CREATE INDEX general_translations_lookup_idx ON ext_translations (object_class, foreign_key)');
        //$this->addSql('CREATE UNIQUE INDEX lookup_unique_idx ON ext_translations (locale, object_class, field, foreign_key)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ext_translations');
    }
}

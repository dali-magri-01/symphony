<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231015165136 extends AbstractMigration
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
        $this->addSql('DROP SEQUENCE MESSENGER_MESSAGES_SEQ');
        $this->addSql('ALTER TABLE SOCIETE MODIFY (actif NUMBER(1) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE MESSENGER_MESSAGES_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('ALTER TABLE societe MODIFY (ACTIF VARCHAR2(1) DEFAULT NULL NULL)');
    }
}

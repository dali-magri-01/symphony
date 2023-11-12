<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231105125907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE MESSENGER_MESSAGES_SEQ');
        $this->addSql('CREATE SEQUENCE menu_id_seq START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('CREATE TABLE menu (id NUMBER(10) NOT NULL, name VARCHAR2(255) DEFAULT NULL NULL, parent_id NUMBER(10) DEFAULT NULL NULL, ordre NUMBER(10) DEFAULT NULL NULL, link VARCHAR2(255) DEFAULT NULL NULL, create_at TIMESTAMP(0) DEFAULT NULL NULL, update_at TIMESTAMP(0) DEFAULT NULL NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE menu_id_seq');
        $this->addSql('CREATE SEQUENCE MESSENGER_MESSAGES_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1');
        $this->addSql('DROP TABLE menu');
    }
}

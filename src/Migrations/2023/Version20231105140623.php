<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231105140623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE MENU ADD (created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL)');
        $this->addSql('ALTER TABLE MENU DROP (CREATE_AT, UPDATE_AT)');
        $this->addSql('ALTER TABLE SOCIETE ADD (created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL)');
        $this->addSql('ALTER TABLE SOCIETE DROP (CREATE_AT, UPDATE_AT)');
        $this->addSql('ALTER TABLE "user" ADD (created_at TIMESTAMP(0) NOT NULL, updated_at TIMESTAMP(0) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe ADD (CREATE_AT TIMESTAMP(0) DEFAULT NULL NULL, UPDATE_AT TIMESTAMP(0) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE societe DROP (created_at, updated_at)');
        $this->addSql('ALTER TABLE menu ADD (CREATE_AT TIMESTAMP(0) DEFAULT NULL NULL, UPDATE_AT TIMESTAMP(0) DEFAULT NULL NULL)');
        $this->addSql('ALTER TABLE menu DROP (created_at, updated_at)');
        $this->addSql('ALTER TABLE "user" DROP (created_at, updated_at)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321134833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_6be5cee198d3fe22');
        $this->addSql('CREATE INDEX IDX_6BE5CEE198D3FE22 ON PIECE_COMPTABLE (monnaie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_6BE5CEE198D3FE22');
        $this->addSql('CREATE UNIQUE INDEX uniq_6be5cee198d3fe22 ON piece_comptable (MONNAIE_ID)');
    }
}

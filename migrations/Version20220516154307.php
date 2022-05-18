<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516154307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE energy_source ADD COLUMN year INTEGER NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__energy_source AS SELECT id, bio, water, wind, heat, sun, total FROM energy_source');
        $this->addSql('DROP TABLE energy_source');
        $this->addSql('CREATE TABLE energy_source (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, bio VARCHAR(255) DEFAULT NULL, water VARCHAR(255) DEFAULT NULL, wind VARCHAR(255) DEFAULT NULL, heat VARCHAR(255) DEFAULT NULL, sun VARCHAR(255) DEFAULT NULL, total VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO energy_source (id, bio, water, wind, heat, sun, total) SELECT id, bio, water, wind, heat, sun, total FROM __temp__energy_source');
        $this->addSql('DROP TABLE __temp__energy_source');
    }
}

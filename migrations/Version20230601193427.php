<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230601193427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT fk_5f9e962a60bb6fe6');
        $this->addSql('DROP INDEX idx_5f9e962a60bb6fe6');
        $this->addSql('ALTER TABLE comments DROP auteur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comments ADD auteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT fk_5f9e962a60bb6fe6 FOREIGN KEY (auteur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5f9e962a60bb6fe6 ON comments (auteur_id)');
    }
}

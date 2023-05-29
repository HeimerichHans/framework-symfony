<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529010905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE list_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE list_type (id INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT fk_5f9e962a78b8f2ac');
        $this->addSql('DROP INDEX idx_5f9e962a78b8f2ac');
        $this->addSql('ALTER TABLE comments DROP moto_id');
        $this->addSql('ALTER TABLE moto ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE moto ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE moto ADD CONSTRAINT FK_3DDDBCE4C54C8C93 FOREIGN KEY (type_id) REFERENCES list_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3DDDBCE4C54C8C93 ON moto (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE moto DROP CONSTRAINT FK_3DDDBCE4C54C8C93');
        $this->addSql('DROP SEQUENCE list_type_id_seq CASCADE');
        $this->addSql('DROP TABLE list_type');
        $this->addSql('ALTER TABLE comments ADD moto_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT fk_5f9e962a78b8f2ac FOREIGN KEY (moto_id) REFERENCES moto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5f9e962a78b8f2ac ON comments (moto_id)');
        $this->addSql('DROP INDEX IDX_3DDDBCE4C54C8C93');
        $this->addSql('ALTER TABLE moto DROP type_id');
        $this->addSql('ALTER TABLE moto DROP image');
    }
}

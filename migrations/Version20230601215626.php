<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230601215626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments ADD moto_comments_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD user_comments_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A5619D0D7 FOREIGN KEY (moto_comments_id) REFERENCES moto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962ACA2C5C13 FOREIGN KEY (user_comments_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5F9E962A5619D0D7 ON comments (moto_comments_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962ACA2C5C13 ON comments (user_comments_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962A5619D0D7');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962ACA2C5C13');
        $this->addSql('DROP INDEX IDX_5F9E962A5619D0D7');
        $this->addSql('DROP INDEX IDX_5F9E962ACA2C5C13');
        $this->addSql('ALTER TABLE comments DROP moto_comments_id');
        $this->addSql('ALTER TABLE comments DROP user_comments_id');
    }
}

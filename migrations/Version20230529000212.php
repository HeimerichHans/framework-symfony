<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529000212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE color_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE comments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE list_brand_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE list_color_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE list_cylinder_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE moto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE comments (id INT NOT NULL, auteur_id INT DEFAULT NULL, moto_id INT NOT NULL, texte VARCHAR(4096) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F9E962A60BB6FE6 ON comments (auteur_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A78B8F2AC ON comments (moto_id)');
        $this->addSql('CREATE TABLE list_brand (id INT NOT NULL, marque VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE list_color (id INT NOT NULL, couleur VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE list_cylinder (id INT NOT NULL, cylindre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE moto (id INT NOT NULL, couleur_id INT NOT NULL, cylindre_id INT NOT NULL, marque_id INT NOT NULL, modele VARCHAR(255) NOT NULL, annee NUMERIC(4, 0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3DDDBCE4C31BA576 ON moto (couleur_id)');
        $this->addSql('CREATE INDEX IDX_3DDDBCE48318F4EF ON moto (cylindre_id)');
        $this->addSql('CREATE INDEX IDX_3DDDBCE44827B9B2 ON moto (marque_id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A78B8F2AC FOREIGN KEY (moto_id) REFERENCES moto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE moto ADD CONSTRAINT FK_3DDDBCE4C31BA576 FOREIGN KEY (couleur_id) REFERENCES list_color (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE moto ADD CONSTRAINT FK_3DDDBCE48318F4EF FOREIGN KEY (cylindre_id) REFERENCES list_cylinder (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE moto ADD CONSTRAINT FK_3DDDBCE44827B9B2 FOREIGN KEY (marque_id) REFERENCES list_brand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE color');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE comments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE list_brand_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE list_color_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE list_cylinder_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE moto_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE color_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE color (id INT NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962A60BB6FE6');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962A78B8F2AC');
        $this->addSql('ALTER TABLE moto DROP CONSTRAINT FK_3DDDBCE4C31BA576');
        $this->addSql('ALTER TABLE moto DROP CONSTRAINT FK_3DDDBCE48318F4EF');
        $this->addSql('ALTER TABLE moto DROP CONSTRAINT FK_3DDDBCE44827B9B2');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE list_brand');
        $this->addSql('DROP TABLE list_color');
        $this->addSql('DROP TABLE list_cylinder');
        $this->addSql('DROP TABLE moto');
    }
}

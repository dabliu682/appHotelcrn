<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250715215414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creacion de tabla de servicios y tipos de servicios';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE services_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE servicetype_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE services (id INT NOT NULL, tipo_id INT NOT NULL, code TEXT NOT NULL, name TEXT NOT NULL, price DOUBLE PRECISION NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7332E169A9276E6C ON services (tipo_id)');
        $this->addSql('CREATE TABLE servicetype (id INT NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E169A9276E6C FOREIGN KEY (tipo_id) REFERENCES servicetype (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE services_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE servicetype_id_seq CASCADE');
        $this->addSql('ALTER TABLE services DROP CONSTRAINT FK_7332E169A9276E6C');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE servicetype');
    }
}

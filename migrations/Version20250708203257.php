<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250708203257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE turnos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE turnos (id INT NOT NULL, usuario_id INT NOT NULL, startdate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, enddate TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B8555818DB38439E ON turnos (usuario_id)');
        $this->addSql('ALTER TABLE turnos ADD CONSTRAINT FK_B8555818DB38439E FOREIGN KEY (usuario_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE turnos_id_seq CASCADE');
        $this->addSql('ALTER TABLE turnos DROP CONSTRAINT FK_B8555818DB38439E');
        $this->addSql('DROP TABLE turnos');
    }
}

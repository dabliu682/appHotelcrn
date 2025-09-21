<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250909025301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movimientos ADD turno_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE movimientos ADD CONSTRAINT FK_AB16A83969C5211E FOREIGN KEY (turno_id) REFERENCES turnos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AB16A83969C5211E ON movimientos (turno_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE movimientos DROP CONSTRAINT FK_AB16A83969C5211E');
        $this->addSql('DROP INDEX IDX_AB16A83969C5211E');
        $this->addSql('ALTER TABLE movimientos DROP turno_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250807165834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkin ADD habitacion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE checkin ADD CONSTRAINT FK_E1631C91B009290D FOREIGN KEY (habitacion_id) REFERENCES rooms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E1631C91B009290D ON checkin (habitacion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE checkin DROP CONSTRAINT FK_E1631C91B009290D');
        $this->addSql('DROP INDEX IDX_E1631C91B009290D');
        $this->addSql('ALTER TABLE checkin DROP habitacion_id');
    }
}

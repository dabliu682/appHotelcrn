<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250817231357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkin ADD movimiento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE checkin ADD CONSTRAINT FK_E1631C9158E7D5A2 FOREIGN KEY (movimiento_id) REFERENCES movimientos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E1631C9158E7D5A2 ON checkin (movimiento_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE checkin DROP CONSTRAINT FK_E1631C9158E7D5A2');
        $this->addSql('DROP INDEX IDX_E1631C9158E7D5A2');
        $this->addSql('ALTER TABLE checkin DROP movimiento_id');
    }
}

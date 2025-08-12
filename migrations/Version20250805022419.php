<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250805022419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkin ALTER fechasalida DROP NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER horasalida DROP NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER toalla DROP NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER aire DROP NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER cobija DROP NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER control DROP NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER llaves DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE checkin ALTER fechasalida SET NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER horasalida SET NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER toalla SET NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER aire SET NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER cobija SET NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER control SET NOT NULL');
        $this->addSql('ALTER TABLE checkin ALTER llaves SET NOT NULL');
    }
}

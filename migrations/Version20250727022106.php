<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250727022106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventario DROP CONSTRAINT fk_6a194ef56988c885');
        $this->addSql('DROP INDEX idx_6a194ef56988c885');
        $this->addSql('ALTER TABLE inventario DROP usucrea_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inventario ADD usucrea_id INT NOT NULL');
        $this->addSql('ALTER TABLE inventario ADD CONSTRAINT fk_6a194ef56988c885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6a194ef56988c885 ON inventario (usucrea_id)');
    }
}

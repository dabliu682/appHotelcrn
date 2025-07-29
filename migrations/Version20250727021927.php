<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250727021927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventario DROP CONSTRAINT fk_6a194ef572b20b2f');
        $this->addSql('DROP INDEX idx_6a194ef572b20b2f');
        $this->addSql('ALTER TABLE inventario DROP usumodifica_id');
        $this->addSql('ALTER TABLE inventario DROP fechacrea');
        $this->addSql('ALTER TABLE inventario DROP fechamod');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inventario ADD usumodifica_id INT NOT NULL');
        $this->addSql('ALTER TABLE inventario ADD fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE inventario ADD fechamod TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE inventario ADD CONSTRAINT fk_6a194ef572b20b2f FOREIGN KEY (usumodifica_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6a194ef572b20b2f ON inventario (usumodifica_id)');
    }
}

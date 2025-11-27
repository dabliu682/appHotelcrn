<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251127022303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bonos ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE bonos ADD CONSTRAINT FK_2FB585A1DB38439E FOREIGN KEY (usuario_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2FB585A1DB38439E ON bonos (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ALTER turno SET DEFAULT false');
        $this->addSql('ALTER TABLE bonos DROP CONSTRAINT FK_2FB585A1DB38439E');
        $this->addSql('DROP INDEX IDX_2FB585A1DB38439E');
        $this->addSql('ALTER TABLE bonos DROP usuario_id');
    }
}

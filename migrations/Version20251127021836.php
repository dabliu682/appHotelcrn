<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251127021836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bonos DROP CONSTRAINT fk_2fb585a14b64abc7');
        $this->addSql('DROP INDEX idx_2fb585a14b64abc7');
        $this->addSql('ALTER TABLE bonos DROP beneficiario_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bonos ADD beneficiario_id INT NOT NULL');
        $this->addSql('ALTER TABLE bonos ADD CONSTRAINT fk_2fb585a14b64abc7 FOREIGN KEY (beneficiario_id) REFERENCES persons (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2fb585a14b64abc7 ON bonos (beneficiario_id)');
    }
}

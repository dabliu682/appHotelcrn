<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250715223619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE services ADD usucrea_id INT NOT NULL');
        $this->addSql('ALTER TABLE services ADD fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E1696988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7332E1696988C885 ON services (usucrea_id)');
        $this->addSql('ALTER TABLE servicetype ADD usucrea_id INT NOT NULL');
        $this->addSql('ALTER TABLE servicetype ADD fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE servicetype ADD CONSTRAINT FK_E3E53DA46988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E3E53DA46988C885 ON servicetype (usucrea_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE servicetype DROP CONSTRAINT FK_E3E53DA46988C885');
        $this->addSql('DROP INDEX IDX_E3E53DA46988C885');
        $this->addSql('ALTER TABLE servicetype DROP usucrea_id');
        $this->addSql('ALTER TABLE servicetype DROP fechacrea');
        $this->addSql('ALTER TABLE services DROP CONSTRAINT FK_7332E1696988C885');
        $this->addSql('DROP INDEX IDX_7332E1696988C885');
        $this->addSql('ALTER TABLE services DROP usucrea_id');
        $this->addSql('ALTER TABLE services DROP fechacrea');
    }
}

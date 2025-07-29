<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250727022556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventario ADD usucrea_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventario ADD usumod_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventario ADD fechacrea TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE inventario ADD fechamod TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE inventario ADD CONSTRAINT FK_6A194EF56988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventario ADD CONSTRAINT FK_6A194EF542FE7BA5 FOREIGN KEY (usumod_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6A194EF56988C885 ON inventario (usucrea_id)');
        $this->addSql('CREATE INDEX IDX_6A194EF542FE7BA5 ON inventario (usumod_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inventario DROP CONSTRAINT FK_6A194EF56988C885');
        $this->addSql('ALTER TABLE inventario DROP CONSTRAINT FK_6A194EF542FE7BA5');
        $this->addSql('DROP INDEX IDX_6A194EF56988C885');
        $this->addSql('DROP INDEX IDX_6A194EF542FE7BA5');
        $this->addSql('ALTER TABLE inventario DROP usucrea_id');
        $this->addSql('ALTER TABLE inventario DROP usumod_id');
        $this->addSql('ALTER TABLE inventario DROP fechacrea');
        $this->addSql('ALTER TABLE inventario DROP fechamod');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251021022845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bonos ADD usucobro_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bonos ADD fechacobro TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE bonos ADD CONSTRAINT FK_2FB585A15C498A81 FOREIGN KEY (usucobro_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2FB585A15C498A81 ON bonos (usucobro_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bonos DROP CONSTRAINT FK_2FB585A15C498A81');
        $this->addSql('DROP INDEX IDX_2FB585A15C498A81');
        $this->addSql('ALTER TABLE bonos DROP usucobro_id');
        $this->addSql('ALTER TABLE bonos DROP fechacobro');
    }
}

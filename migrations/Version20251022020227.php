<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251022020227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creacion de tabla para el control de gastos';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE gastos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE gastos (id INT NOT NULL, usucrea_id INT NOT NULL, valor DOUBLE PRECISION NOT NULL, tipo INT NOT NULL, fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_17A58AC6988C885 ON gastos (usucrea_id)');
        $this->addSql('ALTER TABLE gastos ADD CONSTRAINT FK_17A58AC6988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE gastos_id_seq CASCADE');
        $this->addSql('ALTER TABLE gastos DROP CONSTRAINT FK_17A58AC6988C885');
        $this->addSql('DROP TABLE gastos');
    }
}

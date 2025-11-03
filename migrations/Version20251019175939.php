<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251019175939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'creación de tabla para el registro de bonos';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bonos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bonos (id INT NOT NULL, beneficiario_id INT NOT NULL, turno_id INT NOT NULL, usucrea_id INT NOT NULL, valor DOUBLE PRECISION NOT NULL, fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, estado INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FB585A14B64ABC7 ON bonos (beneficiario_id)');
        $this->addSql('CREATE INDEX IDX_2FB585A169C5211E ON bonos (turno_id)');
        $this->addSql('CREATE INDEX IDX_2FB585A16988C885 ON bonos (usucrea_id)');
        $this->addSql('ALTER TABLE bonos ADD CONSTRAINT FK_2FB585A14B64ABC7 FOREIGN KEY (beneficiario_id) REFERENCES persons (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bonos ADD CONSTRAINT FK_2FB585A169C5211E FOREIGN KEY (turno_id) REFERENCES turnos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bonos ADD CONSTRAINT FK_2FB585A16988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bonos_id_seq CASCADE');
        $this->addSql('ALTER TABLE bonos DROP CONSTRAINT FK_2FB585A14B64ABC7');
        $this->addSql('ALTER TABLE bonos DROP CONSTRAINT FK_2FB585A169C5211E');
        $this->addSql('ALTER TABLE bonos DROP CONSTRAINT FK_2FB585A16988C885');
        $this->addSql('DROP TABLE bonos');
    }
}

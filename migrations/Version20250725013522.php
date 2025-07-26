<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250725013522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creación de entidades para inventario de productos';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE entradas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE inventario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE productos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE entradas (id INT NOT NULL, codigo_id INT NOT NULL, usucrea_id INT NOT NULL, cantidad INT NOT NULL, valor DOUBLE PRECISION NOT NULL, valundent DOUBLE PRECISION NOT NULL, porcentaje INT NOT NULL, valundsalida DOUBLE PRECISION NOT NULL, valventa DOUBLE PRECISION NOT NULL, utilidad DOUBLE PRECISION NOT NULL, descripcion TEXT DEFAULT NULL, fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4CAF338CB797D96 ON entradas (codigo_id)');
        $this->addSql('CREATE INDEX IDX_4CAF338C6988C885 ON entradas (usucrea_id)');
        $this->addSql('CREATE TABLE inventario (id INT NOT NULL, codigo_id INT NOT NULL, usucrea_id INT NOT NULL, usumodifica_id INT NOT NULL, entradas INT NOT NULL, salidas INT NOT NULL, existencias INT NOT NULL, fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fechamod TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A194EF5B797D96 ON inventario (codigo_id)');
        $this->addSql('CREATE INDEX IDX_6A194EF56988C885 ON inventario (usucrea_id)');
        $this->addSql('CREATE INDEX IDX_6A194EF572B20B2F ON inventario (usumodifica_id)');
        $this->addSql('CREATE TABLE productos (id INT NOT NULL, usucrea_id INT NOT NULL, codigo TEXT NOT NULL, tipo INT NOT NULL, nombre TEXT NOT NULL, valor DOUBLE PRECISION NOT NULL, fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_767490E66988C885 ON productos (usucrea_id)');
        $this->addSql('ALTER TABLE entradas ADD CONSTRAINT FK_4CAF338CB797D96 FOREIGN KEY (codigo_id) REFERENCES productos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entradas ADD CONSTRAINT FK_4CAF338C6988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventario ADD CONSTRAINT FK_6A194EF5B797D96 FOREIGN KEY (codigo_id) REFERENCES productos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventario ADD CONSTRAINT FK_6A194EF56988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventario ADD CONSTRAINT FK_6A194EF572B20B2F FOREIGN KEY (usumodifica_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE productos ADD CONSTRAINT FK_767490E66988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE entradas_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE inventario_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE productos_id_seq CASCADE');
        $this->addSql('ALTER TABLE entradas DROP CONSTRAINT FK_4CAF338CB797D96');
        $this->addSql('ALTER TABLE entradas DROP CONSTRAINT FK_4CAF338C6988C885');
        $this->addSql('ALTER TABLE inventario DROP CONSTRAINT FK_6A194EF5B797D96');
        $this->addSql('ALTER TABLE inventario DROP CONSTRAINT FK_6A194EF56988C885');
        $this->addSql('ALTER TABLE inventario DROP CONSTRAINT FK_6A194EF572B20B2F');
        $this->addSql('ALTER TABLE productos DROP CONSTRAINT FK_767490E66988C885');
        $this->addSql('DROP TABLE entradas');
        $this->addSql('DROP TABLE inventario');
        $this->addSql('DROP TABLE productos');
    }
}

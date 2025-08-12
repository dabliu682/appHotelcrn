<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250805020843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'creación de movimientos';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE checkin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE detallesmov_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE movimientos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE checkin (id INT NOT NULL, reserva_id INT DEFAULT NULL, cliente_id INT NOT NULL, turno_id INT NOT NULL, fechallegada DATE NOT NULL, horallegada TIME(0) WITHOUT TIME ZONE NOT NULL, fechasalida DATE NOT NULL, horasalida TIME(0) WITHOUT TIME ZONE NOT NULL, toalla BOOLEAN NOT NULL, aire BOOLEAN NOT NULL, cobija BOOLEAN NOT NULL, control BOOLEAN NOT NULL, llaves BOOLEAN NOT NULL, estado INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1631C91D67139E8 ON checkin (reserva_id)');
        $this->addSql('CREATE INDEX IDX_E1631C91DE734E51 ON checkin (cliente_id)');
        $this->addSql('CREATE INDEX IDX_E1631C9169C5211E ON checkin (turno_id)');
        $this->addSql('CREATE TABLE detallesmov (id INT NOT NULL, mov_id INT NOT NULL, servicio_id INT DEFAULT NULL, producto_id INT DEFAULT NULL, turno_id INT NOT NULL, cantidad INT DEFAULT NULL, valor DOUBLE PRECISION NOT NULL, saldo DOUBLE PRECISION NOT NULL, estado INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D3E4C73C99EBED9 ON detallesmov (mov_id)');
        $this->addSql('CREATE INDEX IDX_D3E4C7371CAA3E7 ON detallesmov (servicio_id)');
        $this->addSql('CREATE INDEX IDX_D3E4C737645698E ON detallesmov (producto_id)');
        $this->addSql('CREATE INDEX IDX_D3E4C7369C5211E ON detallesmov (turno_id)');
        $this->addSql('CREATE TABLE movimientos (id INT NOT NULL, checkin_id INT DEFAULT NULL, fecha DATE NOT NULL, tipo INT NOT NULL, estado INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AB16A839A85C7AA9 ON movimientos (checkin_id)');
        $this->addSql('ALTER TABLE checkin ADD CONSTRAINT FK_E1631C91D67139E8 FOREIGN KEY (reserva_id) REFERENCES booking (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE checkin ADD CONSTRAINT FK_E1631C91DE734E51 FOREIGN KEY (cliente_id) REFERENCES persons (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE checkin ADD CONSTRAINT FK_E1631C9169C5211E FOREIGN KEY (turno_id) REFERENCES turnos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detallesmov ADD CONSTRAINT FK_D3E4C73C99EBED9 FOREIGN KEY (mov_id) REFERENCES movimientos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detallesmov ADD CONSTRAINT FK_D3E4C7371CAA3E7 FOREIGN KEY (servicio_id) REFERENCES services (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detallesmov ADD CONSTRAINT FK_D3E4C737645698E FOREIGN KEY (producto_id) REFERENCES productos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detallesmov ADD CONSTRAINT FK_D3E4C7369C5211E FOREIGN KEY (turno_id) REFERENCES turnos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE movimientos ADD CONSTRAINT FK_AB16A839A85C7AA9 FOREIGN KEY (checkin_id) REFERENCES checkin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE checkin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE detallesmov_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE movimientos_id_seq CASCADE');
        $this->addSql('ALTER TABLE checkin DROP CONSTRAINT FK_E1631C91D67139E8');
        $this->addSql('ALTER TABLE checkin DROP CONSTRAINT FK_E1631C91DE734E51');
        $this->addSql('ALTER TABLE checkin DROP CONSTRAINT FK_E1631C9169C5211E');
        $this->addSql('ALTER TABLE detallesmov DROP CONSTRAINT FK_D3E4C73C99EBED9');
        $this->addSql('ALTER TABLE detallesmov DROP CONSTRAINT FK_D3E4C7371CAA3E7');
        $this->addSql('ALTER TABLE detallesmov DROP CONSTRAINT FK_D3E4C737645698E');
        $this->addSql('ALTER TABLE detallesmov DROP CONSTRAINT FK_D3E4C7369C5211E');
        $this->addSql('ALTER TABLE movimientos DROP CONSTRAINT FK_AB16A839A85C7AA9');
        $this->addSql('DROP TABLE checkin');
        $this->addSql('DROP TABLE detallesmov');
        $this->addSql('DROP TABLE movimientos');
    }
}

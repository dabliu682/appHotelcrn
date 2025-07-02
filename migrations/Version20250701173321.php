<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250701173321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creación de tablas para pisos y habitaciones';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE floors_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rooms_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE floors (id INT NOT NULL, usucrea_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C76687126988C885 ON floors (usucrea_id)');
        $this->addSql('CREATE TABLE rooms (id INT NOT NULL, floor_id INT NOT NULL, usucrea_id INT NOT NULL, name VARCHAR(255) NOT NULL, bed_number VARCHAR(255) DEFAULT NULL, aircond BOOLEAN NOT NULL, fan BOOLEAN NOT NULL, status INT NOT NULL, fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CA11A96854679E2 ON rooms (floor_id)');
        $this->addSql('CREATE INDEX IDX_7CA11A966988C885 ON rooms (usucrea_id)');
        $this->addSql('ALTER TABLE floors ADD CONSTRAINT FK_C76687126988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rooms ADD CONSTRAINT FK_7CA11A96854679E2 FOREIGN KEY (floor_id) REFERENCES floors (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rooms ADD CONSTRAINT FK_7CA11A966988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE floors_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rooms_id_seq CASCADE');
        $this->addSql('ALTER TABLE floors DROP CONSTRAINT FK_C76687126988C885');
        $this->addSql('ALTER TABLE rooms DROP CONSTRAINT FK_7CA11A96854679E2');
        $this->addSql('ALTER TABLE rooms DROP CONSTRAINT FK_7CA11A966988C885');
        $this->addSql('DROP TABLE floors');
        $this->addSql('DROP TABLE rooms');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250705013527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE companys_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE documents_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE persons_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE companys (id INT NOT NULL, usuariocrea_id INT NOT NULL, nit VARCHAR(100) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD222C0329B1553F ON companys (usuariocrea_id)');
        $this->addSql('CREATE TABLE documents (id INT NOT NULL, usucrea_id INT NOT NULL, name VARCHAR(255) NOT NULL, fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A2B072886988C885 ON documents (usucrea_id)');
        $this->addSql('CREATE TABLE persons (id INT NOT NULL, document_id INT NOT NULL, compania_id INT NOT NULL, usucrea_id INT NOT NULL, document_number VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, cellphone VARCHAR(100) DEFAULT NULL, fechacrea TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A25CC7D3C33F7837 ON persons (document_id)');
        $this->addSql('CREATE INDEX IDX_A25CC7D312A65948 ON persons (compania_id)');
        $this->addSql('CREATE INDEX IDX_A25CC7D36988C885 ON persons (usucrea_id)');
        $this->addSql('ALTER TABLE companys ADD CONSTRAINT FK_FD222C0329B1553F FOREIGN KEY (usuariocrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B072886988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persons ADD CONSTRAINT FK_A25CC7D3C33F7837 FOREIGN KEY (document_id) REFERENCES documents (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persons ADD CONSTRAINT FK_A25CC7D312A65948 FOREIGN KEY (compania_id) REFERENCES companys (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persons ADD CONSTRAINT FK_A25CC7D36988C885 FOREIGN KEY (usucrea_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE companys_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE documents_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE persons_id_seq CASCADE');
        $this->addSql('ALTER TABLE companys DROP CONSTRAINT FK_FD222C0329B1553F');
        $this->addSql('ALTER TABLE documents DROP CONSTRAINT FK_A2B072886988C885');
        $this->addSql('ALTER TABLE persons DROP CONSTRAINT FK_A25CC7D3C33F7837');
        $this->addSql('ALTER TABLE persons DROP CONSTRAINT FK_A25CC7D312A65948');
        $this->addSql('ALTER TABLE persons DROP CONSTRAINT FK_A25CC7D36988C885');
        $this->addSql('DROP TABLE companys');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE persons');
    }
}

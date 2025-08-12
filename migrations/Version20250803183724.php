<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250803183724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Elimina todos los registros de servicetype, reinicia la secuencia y agrega tres registros nuevos';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        // 1. Eliminar todos los registros
        $this->addSql('DELETE FROM servicetype');

        // 2. Reiniciar la secuencia
        $this->addSql("ALTER SEQUENCE servicetype_id_seq RESTART WITH 1");

        // 3. Insertar nuevos registros
        $this->addSql("
            INSERT INTO servicetype (id, name, usucrea_id, fechacrea)
            VALUES 
                (nextval('servicetype_id_seq'), 'Hospedaje motoristas', 1, NOW()),
                (nextval('servicetype_id_seq'), 'Hospedaje turista', 1, NOW()),
                (nextval('servicetype_id_seq'), 'Hospedaje', 1, NOW()),
                (nextval('servicetype_id_seq'), 'Lavandería', 1, NOW())
        ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}

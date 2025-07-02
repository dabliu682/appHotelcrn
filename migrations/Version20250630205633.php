<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250630205633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creacion de un usuario admin con rol ROLE_ADMIN y password "admin"';
    }

    public function up(Schema $schema): void
    {
        $password = '$2a$12$NYq7v8dvDBcrzjhtbH2TyOSP.NiDojHkvkefCtXzCMb/uwaGgdhM.';
        $this->addSql("INSERT INTO \"user\" (id, username, roles, password, name) VALUES (nextval('user_id_seq'), 'Admin', '[\"ROLE_SUPERUSER\"]', '" . $password . "', 'ADMINISTRADOR DEL SISTEMA')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}

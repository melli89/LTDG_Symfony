<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521182916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE monturas (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, movimiento INT DEFAULT NULL, ha INT DEFAULT NULL, hp INT DEFAULT NULL, resistencia INT DEFAULT NULL, fuerza INT DEFAULT NULL, heridas INT DEFAULT NULL, iniciativa INT DEFAULT NULL, ataques INT DEFAULT NULL, liderazgo INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unidadesymonturas (id INT AUTO_INCREMENT NOT NULL, id_unidad_id INT DEFAULT NULL, id_monturas_id INT DEFAULT NULL, puntos INT NOT NULL, INDEX IDX_CF05E8A01D34FA6B (id_unidad_id), INDEX IDX_CF05E8A0C8E0236E (id_monturas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE unidadesymonturas ADD CONSTRAINT FK_CF05E8A01D34FA6B FOREIGN KEY (id_unidad_id) REFERENCES unidades (id)');
        $this->addSql('ALTER TABLE unidadesymonturas ADD CONSTRAINT FK_CF05E8A0C8E0236E FOREIGN KEY (id_monturas_id) REFERENCES monturas (id)');
        $this->addSql('ALTER TABLE mejoras ADD rango VARCHAR(100) DEFAULT NULL, ADD fuerza VARCHAR(30) DEFAULT NULL, ADD penetracion VARCHAR(30) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unidadesymonturas DROP FOREIGN KEY FK_CF05E8A01D34FA6B');
        $this->addSql('ALTER TABLE unidadesymonturas DROP FOREIGN KEY FK_CF05E8A0C8E0236E');
        $this->addSql('DROP TABLE monturas');
        $this->addSql('DROP TABLE unidadesymonturas');
        $this->addSql('ALTER TABLE mejoras DROP rango, DROP fuerza, DROP penetracion');
    }
}

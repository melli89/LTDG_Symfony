<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240520192550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unidades_ymejoras (id INT AUTO_INCREMENT NOT NULL, id_unidad_id INT NOT NULL, idmejora_id INT NOT NULL, puntos INT NOT NULL, INDEX IDX_DB3353AA1D34FA6B (id_unidad_id), INDEX IDX_DB3353AAE2D9E4B8 (idmejora_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE unidades_ymejoras ADD CONSTRAINT FK_DB3353AA1D34FA6B FOREIGN KEY (id_unidad_id) REFERENCES unidades (id)');
        $this->addSql('ALTER TABLE unidades_ymejoras ADD CONSTRAINT FK_DB3353AAE2D9E4B8 FOREIGN KEY (idmejora_id) REFERENCES mejoras (id)');
        $this->addSql('ALTER TABLE mejoras DROP ptos');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unidades_ymejoras DROP FOREIGN KEY FK_DB3353AA1D34FA6B');
        $this->addSql('ALTER TABLE unidades_ymejoras DROP FOREIGN KEY FK_DB3353AAE2D9E4B8');
        $this->addSql('DROP TABLE unidades_ymejoras');
        $this->addSql('ALTER TABLE mejoras ADD ptos INT NOT NULL');
    }
}

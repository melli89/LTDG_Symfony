<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509211802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mejoras_unidad (id INT AUTO_INCREMENT NOT NULL, unidad_id INT NOT NULL, mejora_id_id INT NOT NULL, opcional VARCHAR(5) NOT NULL, INDEX IDX_F4CBB78C9D01464C (unidad_id), INDEX IDX_F4CBB78C2EBE49EB (mejora_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mejoras_unidad ADD CONSTRAINT FK_F4CBB78C9D01464C FOREIGN KEY (unidad_id) REFERENCES unidades (id)');
        $this->addSql('ALTER TABLE mejoras_unidad ADD CONSTRAINT FK_F4CBB78C2EBE49EB FOREIGN KEY (mejora_id_id) REFERENCES mejoras (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mejoras_unidad DROP FOREIGN KEY FK_F4CBB78C9D01464C');
        $this->addSql('ALTER TABLE mejoras_unidad DROP FOREIGN KEY FK_F4CBB78C2EBE49EB');
        $this->addSql('DROP TABLE mejoras_unidad');
    }
}

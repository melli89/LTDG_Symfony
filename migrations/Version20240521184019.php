<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521184019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campeon_objetosmagicos (campeon_id INT NOT NULL, objetosmagicos_id INT NOT NULL, INDEX IDX_97C657DE3466C5C4 (campeon_id), INDEX IDX_97C657DE76E40121 (objetosmagicos_id), PRIMARY KEY(campeon_id, objetosmagicos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campeon_objetos_magicos (id INT AUTO_INCREMENT NOT NULL, campeon_id INT NOT NULL, relation_id INT NOT NULL, INDEX IDX_9303D1DA3466C5C4 (campeon_id), INDEX IDX_9303D1DA3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mejoras_unidades (mejoras_id INT NOT NULL, unidades_id INT NOT NULL, INDEX IDX_526CA838EF804245 (mejoras_id), INDEX IDX_526CA83880410350 (unidades_id), PRIMARY KEY(mejoras_id, unidades_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objetos_magicos_unidades (objetos_magicos_id INT NOT NULL, unidades_id INT NOT NULL, INDEX IDX_A9972B17D166D527 (objetos_magicos_id), INDEX IDX_A9972B1780410350 (unidades_id), PRIMARY KEY(objetos_magicos_id, unidades_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reglas_especiales_unidades (reglas_especiales_id INT NOT NULL, unidades_id INT NOT NULL, INDEX IDX_6188B8368E514D1E (reglas_especiales_id), INDEX IDX_6188B83680410350 (unidades_id), PRIMARY KEY(reglas_especiales_id, unidades_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE campeon_objetosmagicos ADD CONSTRAINT FK_97C657DE3466C5C4 FOREIGN KEY (campeon_id) REFERENCES campeon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campeon_objetosmagicos ADD CONSTRAINT FK_97C657DE76E40121 FOREIGN KEY (objetosmagicos_id) REFERENCES objetos_magicos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campeon_objetos_magicos ADD CONSTRAINT FK_9303D1DA3466C5C4 FOREIGN KEY (campeon_id) REFERENCES objetos_magicos (id)');
        $this->addSql('ALTER TABLE campeon_objetos_magicos ADD CONSTRAINT FK_9303D1DA3256915B FOREIGN KEY (relation_id) REFERENCES campeon (id)');
        $this->addSql('ALTER TABLE mejoras_unidades ADD CONSTRAINT FK_526CA838EF804245 FOREIGN KEY (mejoras_id) REFERENCES mejoras (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mejoras_unidades ADD CONSTRAINT FK_526CA83880410350 FOREIGN KEY (unidades_id) REFERENCES unidades (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objetos_magicos_unidades ADD CONSTRAINT FK_A9972B17D166D527 FOREIGN KEY (objetos_magicos_id) REFERENCES objetos_magicos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objetos_magicos_unidades ADD CONSTRAINT FK_A9972B1780410350 FOREIGN KEY (unidades_id) REFERENCES unidades (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reglas_especiales_unidades ADD CONSTRAINT FK_6188B8368E514D1E FOREIGN KEY (reglas_especiales_id) REFERENCES reglas_especiales (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reglas_especiales_unidades ADD CONSTRAINT FK_6188B83680410350 FOREIGN KEY (unidades_id) REFERENCES unidades (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campeon_objetosmagicos DROP FOREIGN KEY FK_97C657DE3466C5C4');
        $this->addSql('ALTER TABLE campeon_objetosmagicos DROP FOREIGN KEY FK_97C657DE76E40121');
        $this->addSql('ALTER TABLE campeon_objetos_magicos DROP FOREIGN KEY FK_9303D1DA3466C5C4');
        $this->addSql('ALTER TABLE campeon_objetos_magicos DROP FOREIGN KEY FK_9303D1DA3256915B');
        $this->addSql('ALTER TABLE mejoras_unidades DROP FOREIGN KEY FK_526CA838EF804245');
        $this->addSql('ALTER TABLE mejoras_unidades DROP FOREIGN KEY FK_526CA83880410350');
        $this->addSql('ALTER TABLE objetos_magicos_unidades DROP FOREIGN KEY FK_A9972B17D166D527');
        $this->addSql('ALTER TABLE objetos_magicos_unidades DROP FOREIGN KEY FK_A9972B1780410350');
        $this->addSql('ALTER TABLE reglas_especiales_unidades DROP FOREIGN KEY FK_6188B8368E514D1E');
        $this->addSql('ALTER TABLE reglas_especiales_unidades DROP FOREIGN KEY FK_6188B83680410350');
        $this->addSql('DROP TABLE campeon_objetosmagicos');
        $this->addSql('DROP TABLE campeon_objetos_magicos');
        $this->addSql('DROP TABLE mejoras_unidades');
        $this->addSql('DROP TABLE objetos_magicos_unidades');
        $this->addSql('DROP TABLE reglas_especiales_unidades');
    }
}

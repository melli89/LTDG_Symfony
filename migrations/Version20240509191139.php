<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509191139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atributos (id INT AUTO_INCREMENT NOT NULL, id_unidad_id INT NOT NULL, movimiento INT NOT NULL, habilidad_armas INT NOT NULL, habilidad_proyectil INT NOT NULL, fuerza INT NOT NULL, resistencia INT NOT NULL, heridas INT NOT NULL, iniciativa INT NOT NULL, ataques INT NOT NULL, liderazgo INT NOT NULL, INDEX IDX_168562521D34FA6B (id_unidad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campeon (id INT AUTO_INCREMENT NOT NULL, id_unidad_id INT DEFAULT NULL, puntos INT NOT NULL, ptos_om INT NOT NULL, UNIQUE INDEX UNIQ_E87474651D34FA6B (id_unidad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campeon_objetosmagicos (campeon_id INT NOT NULL, objetosmagicos_id INT NOT NULL, INDEX IDX_97C657DE3466C5C4 (campeon_id), INDEX IDX_97C657DE76E40121 (objetosmagicos_id), PRIMARY KEY(campeon_id, objetosmagicos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campeon_atributos (id INT AUTO_INCREMENT NOT NULL, id_campeon_id INT DEFAULT NULL, movimiento INT NOT NULL, habilidad_arma INT NOT NULL, habilidad_proyectil INT NOT NULL, fuerza INT NOT NULL, resistencia INT NOT NULL, heridas INT NOT NULL, iniciativa INT NOT NULL, ataque INT NOT NULL, liderazgo INT NOT NULL, INDEX IDX_D9CDE9B891EC4513 (id_campeon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ejercito (id INT AUTO_INCREMENT NOT NULL, raza VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listas (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, ejercito_id INT NOT NULL, nombre_lista VARCHAR(200) DEFAULT NULL, puntos_partida INT NOT NULL, INDEX IDX_C54ECE20A76ED395 (user_id), INDEX IDX_C54ECE2017F2F8BB (ejercito_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mejoras (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(300) DEFAULT NULL, ptos INT NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mejoras_unidades (mejoras_id INT NOT NULL, unidades_id INT NOT NULL, INDEX IDX_526CA838EF804245 (mejoras_id), INDEX IDX_526CA83880410350 (unidades_id), PRIMARY KEY(mejoras_id, unidades_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musico (id INT AUTO_INCREMENT NOT NULL, id_unidad_id INT NOT NULL, puntos INT NOT NULL, UNIQUE INDEX UNIQ_99CB69E81D34FA6B (id_unidad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objetos_magicos (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(300) DEFAULT NULL, nombre VARCHAR(100) NOT NULL, categoria VARCHAR(100) NOT NULL, ptos INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objetos_magicos_unidades (objetos_magicos_id INT NOT NULL, unidades_id INT NOT NULL, INDEX IDX_A9972B17D166D527 (objetos_magicos_id), INDEX IDX_A9972B1780410350 (unidades_id), PRIMARY KEY(objetos_magicos_id, unidades_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portaestandarte (id INT AUTO_INCREMENT NOT NULL, id_unidad_id INT NOT NULL, puntos INT NOT NULL, puntos_estandarte INT NOT NULL, UNIQUE INDEX UNIQ_606B8AED1D34FA6B (id_unidad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portaestandarte_objetosmagicos (portaestandarte_id INT NOT NULL, objetosmagicos_id INT NOT NULL, INDEX IDX_41F30834DC774EB2 (portaestandarte_id), INDEX IDX_41F3083476E40121 (objetosmagicos_id), PRIMARY KEY(portaestandarte_id, objetosmagicos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reglas_especiales (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(500) DEFAULT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reglas_especiales_unidades (reglas_especiales_id INT NOT NULL, unidades_id INT NOT NULL, INDEX IDX_6188B8368E514D1E (reglas_especiales_id), INDEX IDX_6188B83680410350 (unidades_id), PRIMARY KEY(reglas_especiales_id, unidades_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unidades (id INT AUTO_INCREMENT NOT NULL, ejercito_id INT NOT NULL, categoria VARCHAR(100) NOT NULL, nombre VARCHAR(50) NOT NULL, tipo VARCHAR(50) DEFAULT NULL, punto_mini INT NOT NULL, tamano_minimo INT NOT NULL, tamano_maximo INT NOT NULL, INDEX IDX_490B4C417F2F8BB (ejercito_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atributos ADD CONSTRAINT FK_168562521D34FA6B FOREIGN KEY (id_unidad_id) REFERENCES unidades (id)');
        $this->addSql('ALTER TABLE campeon ADD CONSTRAINT FK_E87474651D34FA6B FOREIGN KEY (id_unidad_id) REFERENCES unidades (id)');
        $this->addSql('ALTER TABLE campeon_objetosmagicos ADD CONSTRAINT FK_97C657DE3466C5C4 FOREIGN KEY (campeon_id) REFERENCES campeon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campeon_objetosmagicos ADD CONSTRAINT FK_97C657DE76E40121 FOREIGN KEY (objetosmagicos_id) REFERENCES objetos_magicos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campeon_atributos ADD CONSTRAINT FK_D9CDE9B891EC4513 FOREIGN KEY (id_campeon_id) REFERENCES campeon (id)');
        $this->addSql('ALTER TABLE listas ADD CONSTRAINT FK_C54ECE20A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE listas ADD CONSTRAINT FK_C54ECE2017F2F8BB FOREIGN KEY (ejercito_id) REFERENCES ejercito (id)');
        $this->addSql('ALTER TABLE mejoras_unidades ADD CONSTRAINT FK_526CA838EF804245 FOREIGN KEY (mejoras_id) REFERENCES mejoras (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mejoras_unidades ADD CONSTRAINT FK_526CA83880410350 FOREIGN KEY (unidades_id) REFERENCES unidades (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musico ADD CONSTRAINT FK_99CB69E81D34FA6B FOREIGN KEY (id_unidad_id) REFERENCES unidades (id)');
        $this->addSql('ALTER TABLE objetos_magicos_unidades ADD CONSTRAINT FK_A9972B17D166D527 FOREIGN KEY (objetos_magicos_id) REFERENCES objetos_magicos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objetos_magicos_unidades ADD CONSTRAINT FK_A9972B1780410350 FOREIGN KEY (unidades_id) REFERENCES unidades (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portaestandarte ADD CONSTRAINT FK_606B8AED1D34FA6B FOREIGN KEY (id_unidad_id) REFERENCES unidades (id)');
        $this->addSql('ALTER TABLE portaestandarte_objetosmagicos ADD CONSTRAINT FK_41F30834DC774EB2 FOREIGN KEY (portaestandarte_id) REFERENCES portaestandarte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portaestandarte_objetosmagicos ADD CONSTRAINT FK_41F3083476E40121 FOREIGN KEY (objetosmagicos_id) REFERENCES objetos_magicos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reglas_especiales_unidades ADD CONSTRAINT FK_6188B8368E514D1E FOREIGN KEY (reglas_especiales_id) REFERENCES reglas_especiales (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reglas_especiales_unidades ADD CONSTRAINT FK_6188B83680410350 FOREIGN KEY (unidades_id) REFERENCES unidades (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE unidades ADD CONSTRAINT FK_490B4C417F2F8BB FOREIGN KEY (ejercito_id) REFERENCES ejercito (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atributos DROP FOREIGN KEY FK_168562521D34FA6B');
        $this->addSql('ALTER TABLE campeon DROP FOREIGN KEY FK_E87474651D34FA6B');
        $this->addSql('ALTER TABLE campeon_objetosmagicos DROP FOREIGN KEY FK_97C657DE3466C5C4');
        $this->addSql('ALTER TABLE campeon_objetosmagicos DROP FOREIGN KEY FK_97C657DE76E40121');
        $this->addSql('ALTER TABLE campeon_atributos DROP FOREIGN KEY FK_D9CDE9B891EC4513');
        $this->addSql('ALTER TABLE listas DROP FOREIGN KEY FK_C54ECE20A76ED395');
        $this->addSql('ALTER TABLE listas DROP FOREIGN KEY FK_C54ECE2017F2F8BB');
        $this->addSql('ALTER TABLE mejoras_unidades DROP FOREIGN KEY FK_526CA838EF804245');
        $this->addSql('ALTER TABLE mejoras_unidades DROP FOREIGN KEY FK_526CA83880410350');
        $this->addSql('ALTER TABLE musico DROP FOREIGN KEY FK_99CB69E81D34FA6B');
        $this->addSql('ALTER TABLE objetos_magicos_unidades DROP FOREIGN KEY FK_A9972B17D166D527');
        $this->addSql('ALTER TABLE objetos_magicos_unidades DROP FOREIGN KEY FK_A9972B1780410350');
        $this->addSql('ALTER TABLE portaestandarte DROP FOREIGN KEY FK_606B8AED1D34FA6B');
        $this->addSql('ALTER TABLE portaestandarte_objetosmagicos DROP FOREIGN KEY FK_41F30834DC774EB2');
        $this->addSql('ALTER TABLE portaestandarte_objetosmagicos DROP FOREIGN KEY FK_41F3083476E40121');
        $this->addSql('ALTER TABLE reglas_especiales_unidades DROP FOREIGN KEY FK_6188B8368E514D1E');
        $this->addSql('ALTER TABLE reglas_especiales_unidades DROP FOREIGN KEY FK_6188B83680410350');
        $this->addSql('ALTER TABLE unidades DROP FOREIGN KEY FK_490B4C417F2F8BB');
        $this->addSql('DROP TABLE atributos');
        $this->addSql('DROP TABLE campeon');
        $this->addSql('DROP TABLE campeon_objetosmagicos');
        $this->addSql('DROP TABLE campeon_atributos');
        $this->addSql('DROP TABLE ejercito');
        $this->addSql('DROP TABLE listas');
        $this->addSql('DROP TABLE mejoras');
        $this->addSql('DROP TABLE mejoras_unidades');
        $this->addSql('DROP TABLE musico');
        $this->addSql('DROP TABLE objetos_magicos');
        $this->addSql('DROP TABLE objetos_magicos_unidades');
        $this->addSql('DROP TABLE portaestandarte');
        $this->addSql('DROP TABLE portaestandarte_objetosmagicos');
        $this->addSql('DROP TABLE reglas_especiales');
        $this->addSql('DROP TABLE reglas_especiales_unidades');
        $this->addSql('DROP TABLE unidades');
    }
}

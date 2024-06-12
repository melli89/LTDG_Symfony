<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240609190651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unidad_usuario (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, champion_id INT DEFAULT NULL, upgrade_id INT DEFAULT NULL, listas_id INT NOT NULL, minis_amount INT NOT NULL, total_points INT NOT NULL, INDEX IDX_1231F08D7975B7E7 (model_id), INDEX IDX_1231F08DFA7FD7EB (champion_id), INDEX IDX_1231F08D98729BBE (upgrade_id), INDEX IDX_1231F08D9A111542 (listas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE unidad_usuario ADD CONSTRAINT FK_1231F08D7975B7E7 FOREIGN KEY (model_id) REFERENCES unidades (id)');
        $this->addSql('ALTER TABLE unidad_usuario ADD CONSTRAINT FK_1231F08DFA7FD7EB FOREIGN KEY (champion_id) REFERENCES campeon (id)');
        $this->addSql('ALTER TABLE unidad_usuario ADD CONSTRAINT FK_1231F08D98729BBE FOREIGN KEY (upgrade_id) REFERENCES mejoras (id)');
        $this->addSql('ALTER TABLE unidad_usuario ADD CONSTRAINT FK_1231F08D9A111542 FOREIGN KEY (listas_id) REFERENCES listas (id)');
        $this->addSql('ALTER TABLE campeon_objetosmagicos DROP FOREIGN KEY FK_97C657DE76E40121');
        $this->addSql('ALTER TABLE campeon_objetosmagicos DROP FOREIGN KEY FK_97C657DE3466C5C4');
        $this->addSql('DROP TABLE campeon_objetosmagicos');
        $this->addSql('ALTER TABLE campeon_objetos_magicos MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE campeon_objetos_magicos DROP FOREIGN KEY FK_9303D1DA3256915B');
        $this->addSql('ALTER TABLE campeon_objetos_magicos DROP FOREIGN KEY FK_9303D1DA3466C5C4');
        $this->addSql('DROP INDEX IDX_9303D1DA3256915B ON campeon_objetos_magicos');
        $this->addSql('DROP INDEX `primary` ON campeon_objetos_magicos');
        $this->addSql('ALTER TABLE campeon_objetos_magicos DROP id, CHANGE relation_id objetos_magicos_id INT NOT NULL');
        $this->addSql('ALTER TABLE campeon_objetos_magicos ADD CONSTRAINT FK_9303D1DAD166D527 FOREIGN KEY (objetos_magicos_id) REFERENCES objetos_magicos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campeon_objetos_magicos ADD CONSTRAINT FK_9303D1DA3466C5C4 FOREIGN KEY (campeon_id) REFERENCES campeon (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_9303D1DAD166D527 ON campeon_objetos_magicos (objetos_magicos_id)');
        $this->addSql('ALTER TABLE campeon_objetos_magicos ADD PRIMARY KEY (campeon_id, objetos_magicos_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campeon_objetosmagicos (campeon_id INT NOT NULL, objetosmagicos_id INT NOT NULL, INDEX IDX_97C657DE3466C5C4 (campeon_id), INDEX IDX_97C657DE76E40121 (objetosmagicos_id), PRIMARY KEY(campeon_id, objetosmagicos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE campeon_objetosmagicos ADD CONSTRAINT FK_97C657DE76E40121 FOREIGN KEY (objetosmagicos_id) REFERENCES objetos_magicos (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campeon_objetosmagicos ADD CONSTRAINT FK_97C657DE3466C5C4 FOREIGN KEY (campeon_id) REFERENCES campeon (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE unidad_usuario DROP FOREIGN KEY FK_1231F08D7975B7E7');
        $this->addSql('ALTER TABLE unidad_usuario DROP FOREIGN KEY FK_1231F08DFA7FD7EB');
        $this->addSql('ALTER TABLE unidad_usuario DROP FOREIGN KEY FK_1231F08D98729BBE');
        $this->addSql('ALTER TABLE unidad_usuario DROP FOREIGN KEY FK_1231F08D9A111542');
        $this->addSql('DROP TABLE unidad_usuario');
        $this->addSql('ALTER TABLE campeon_objetos_magicos DROP FOREIGN KEY FK_9303D1DAD166D527');
        $this->addSql('ALTER TABLE campeon_objetos_magicos DROP FOREIGN KEY FK_9303D1DA3466C5C4');
        $this->addSql('DROP INDEX IDX_9303D1DAD166D527 ON campeon_objetos_magicos');
        $this->addSql('ALTER TABLE campeon_objetos_magicos ADD id INT AUTO_INCREMENT NOT NULL, CHANGE objetos_magicos_id relation_id INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE campeon_objetos_magicos ADD CONSTRAINT FK_9303D1DA3256915B FOREIGN KEY (relation_id) REFERENCES campeon (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE campeon_objetos_magicos ADD CONSTRAINT FK_9303D1DA3466C5C4 FOREIGN KEY (campeon_id) REFERENCES objetos_magicos (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9303D1DA3256915B ON campeon_objetos_magicos (relation_id)');
    }
}

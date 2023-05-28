<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230528132721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE liste_tache_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tache_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_tache_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE liste_tache (id INT NOT NULL, user_id_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8C7CF4DB9D86650F ON liste_tache (user_id_id)');
        $this->addSql('COMMENT ON COLUMN liste_tache.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN liste_tache.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE tache (id INT NOT NULL, user_tache_id INT DEFAULT NULL, liste_tache_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, priotity INT NOT NULL, date_echeance TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9387207532AEB939 ON tache (user_tache_id)');
        $this->addSql('CREATE INDEX IDX_93872075CEFE06C3 ON tache (liste_tache_id)');
        $this->addSql('COMMENT ON COLUMN tache.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN tache.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_tache (id INT NOT NULL, user_id_id INT DEFAULT NULL, tache_id INT DEFAULT NULL, role VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7145DB2D9D86650F ON user_tache (user_id_id)');
        $this->addSql('CREATE INDEX IDX_7145DB2DD2235D39 ON user_tache (tache_id)');
        $this->addSql('COMMENT ON COLUMN user_tache.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_tache.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE liste_tache ADD CONSTRAINT FK_8C7CF4DB9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_9387207532AEB939 FOREIGN KEY (user_tache_id) REFERENCES user_tache (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075CEFE06C3 FOREIGN KEY (liste_tache_id) REFERENCES liste_tache (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_tache ADD CONSTRAINT FK_7145DB2D9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_tache ADD CONSTRAINT FK_7145DB2DD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE liste_tache_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tache_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_tache_id_seq CASCADE');
        $this->addSql('ALTER TABLE liste_tache DROP CONSTRAINT FK_8C7CF4DB9D86650F');
        $this->addSql('ALTER TABLE tache DROP CONSTRAINT FK_9387207532AEB939');
        $this->addSql('ALTER TABLE tache DROP CONSTRAINT FK_93872075CEFE06C3');
        $this->addSql('ALTER TABLE user_tache DROP CONSTRAINT FK_7145DB2D9D86650F');
        $this->addSql('ALTER TABLE user_tache DROP CONSTRAINT FK_7145DB2DD2235D39');
        $this->addSql('DROP TABLE liste_tache');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE user_tache');
    }
}

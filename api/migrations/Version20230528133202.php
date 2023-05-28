<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230528133202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP CONSTRAINT fk_9387207532aeb939');
        $this->addSql('DROP INDEX idx_9387207532aeb939');
        $this->addSql('ALTER TABLE tache DROP user_tache_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tache ADD user_tache_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT fk_9387207532aeb939 FOREIGN KEY (user_tache_id) REFERENCES user_tache (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9387207532aeb939 ON tache (user_tache_id)');
    }
}

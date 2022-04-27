<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220427150737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sujet ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE sujet ADD CONSTRAINT FK_2E13599DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_2E13599DBCF5E72D ON sujet (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sujet DROP FOREIGN KEY FK_2E13599DBCF5E72D');
        $this->addSql('DROP INDEX IDX_2E13599DBCF5E72D ON sujet');
        $this->addSql('ALTER TABLE sujet DROP categorie_id');
    }
}

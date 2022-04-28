<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428141644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gestion_categorie (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, internaute_id INT NOT NULL, nom_base VARCHAR(30) DEFAULT NULL, type_base INT DEFAULT NULL, date_modification DATETIME NOT NULL, INDEX IDX_B0B874CBCF5E72D (categorie_id), INDEX IDX_B0B874CCAF41882 (internaute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gestion_categorie ADD CONSTRAINT FK_B0B874CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE gestion_categorie ADD CONSTRAINT FK_B0B874CCAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gestion_categorie');
    }
}

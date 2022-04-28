<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428140913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moderation_sujet (id INT AUTO_INCREMENT NOT NULL, sujet_id INT NOT NULL, internaute_id INT NOT NULL, nom_base VARCHAR(255) DEFAULT NULL, contenu_base LONGTEXT DEFAULT NULL, date_modification DATETIME NOT NULL, INDEX IDX_DD49BE097C4D497E (sujet_id), INDEX IDX_DD49BE09CAF41882 (internaute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE moderation_sujet ADD CONSTRAINT FK_DD49BE097C4D497E FOREIGN KEY (sujet_id) REFERENCES sujet (id)');
        $this->addSql('ALTER TABLE moderation_sujet ADD CONSTRAINT FK_DD49BE09CAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE moderation_sujet');
    }
}

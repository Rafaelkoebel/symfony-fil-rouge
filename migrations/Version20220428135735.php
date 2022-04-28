<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428135735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moderation_recette (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, internaute_id INT NOT NULL, titre_base VARCHAR(50) DEFAULT NULL, instruction_base LONGTEXT DEFAULT NULL, image_base VARCHAR(255) DEFAULT NULL, date_modification DATETIME NOT NULL, INDEX IDX_62F8A80F89312FE9 (recette_id), INDEX IDX_62F8A80FCAF41882 (internaute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE moderation_recette ADD CONSTRAINT FK_62F8A80F89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE moderation_recette ADD CONSTRAINT FK_62F8A80FCAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE moderation_recette');
    }
}

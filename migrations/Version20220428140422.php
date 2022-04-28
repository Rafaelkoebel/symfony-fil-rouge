<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428140422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moderation_commentaire (id INT AUTO_INCREMENT NOT NULL, commentaire_id INT NOT NULL, internaute_id INT NOT NULL, contenu_base VARCHAR(255) NOT NULL, date_modification DATETIME NOT NULL, INDEX IDX_68C10569BA9CD190 (commentaire_id), INDEX IDX_68C10569CAF41882 (internaute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE moderation_commentaire ADD CONSTRAINT FK_68C10569BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE moderation_commentaire ADD CONSTRAINT FK_68C10569CAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE moderation_commentaire');
    }
}

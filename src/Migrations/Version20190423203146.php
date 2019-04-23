<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190423203146 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie_article_photo_categorie (categorie_article_id INT NOT NULL, photo_categorie_id INT NOT NULL, INDEX IDX_91FDFD4CEC5D4C30 (categorie_article_id), INDEX IDX_91FDFD4C339EEE3E (photo_categorie_id), PRIMARY KEY(categorie_article_id, photo_categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_possede_photo (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_categorie (id INT AUTO_INCREMENT NOT NULL, description_photo_categorie VARCHAR(255) DEFAULT NULL, photo_categorie LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_article_photo_categorie ADD CONSTRAINT FK_91FDFD4CEC5D4C30 FOREIGN KEY (categorie_article_id) REFERENCES categorie_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_article_photo_categorie ADD CONSTRAINT FK_91FDFD4C339EEE3E FOREIGN KEY (photo_categorie_id) REFERENCES photo_categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie_article_photo_categorie DROP FOREIGN KEY FK_91FDFD4C339EEE3E');
        $this->addSql('DROP TABLE categorie_article_photo_categorie');
        $this->addSql('DROP TABLE categorie_possede_photo');
        $this->addSql('DROP TABLE photo_categorie');
    }
}

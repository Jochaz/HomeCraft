<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190414204007 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, code_article VARCHAR(15) NOT NULL, nom_article VARCHAR(255) NOT NULL, description_article LONGTEXT NOT NULL, date_ajout_article DATETIME NOT NULL, en_vente TINYINT(1) NOT NULL, prix_unitaire_ttc DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_possede_photo (id INT AUTO_INCREMENT NOT NULL, photo_id INT NOT NULL, article_id INT NOT NULL, UNIQUE INDEX UNIQ_A6B5EC7C7E9E4C8C (photo_id), UNIQUE INDEX UNIQ_A6B5EC7C7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_article (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_article (id INT AUTO_INCREMENT NOT NULL, description_photo_article VARCHAR(255) DEFAULT NULL, photo_article LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_possede_photo ADD CONSTRAINT FK_A6B5EC7C7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo_article (id)');
        $this->addSql('ALTER TABLE article_possede_photo ADD CONSTRAINT FK_A6B5EC7C7294869C FOREIGN KEY (article_id) REFERENCES article_blog (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_possede_photo DROP FOREIGN KEY FK_A6B5EC7C7E9E4C8C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_possede_photo');
        $this->addSql('DROP TABLE categorie_article');
        $this->addSql('DROP TABLE photo_article');
    }
}

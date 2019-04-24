<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190424135203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_categorie_article (article_id INT NOT NULL, categorie_article_id INT NOT NULL, INDEX IDX_94A2D4397294869C (article_id), INDEX IDX_94A2D439EC5D4C30 (categorie_article_id), PRIMARY KEY(article_id, categorie_article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_possede_photo (id INT AUTO_INCREMENT NOT NULL, photo_id INT NOT NULL, article_id INT NOT NULL, UNIQUE INDEX UNIQ_A6B5EC7C7E9E4C8C (photo_id), UNIQUE INDEX UNIQ_A6B5EC7C7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_categorie_article ADD CONSTRAINT FK_94A2D4397294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_categorie_article ADD CONSTRAINT FK_94A2D439EC5D4C30 FOREIGN KEY (categorie_article_id) REFERENCES categorie_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_possede_photo ADD CONSTRAINT FK_A6B5EC7C7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo_article (id)');
        $this->addSql('ALTER TABLE article_possede_photo ADD CONSTRAINT FK_A6B5EC7C7294869C FOREIGN KEY (article_id) REFERENCES article_blog (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article_categorie_article');
        $this->addSql('DROP TABLE article_possede_photo');
    }
}

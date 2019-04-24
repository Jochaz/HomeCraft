<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190424071657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, pays_adresse_id INT NOT NULL, type_adresse_id INT NOT NULL, nom_adresse VARCHAR(255) DEFAULT NULL, rue1adresse VARCHAR(255) NOT NULL, rue2adresse VARCHAR(255) DEFAULT NULL, rue3adresse VARCHAR(255) DEFAULT NULL, code_postal_adresse VARCHAR(10) NOT NULL, ville_adresse VARCHAR(255) NOT NULL, INDEX IDX_C35F0816EBC30FB4 (pays_adresse_id), INDEX IDX_C35F081650E40A79 (type_adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_categorie_article (article_id INT NOT NULL, categorie_article_id INT NOT NULL, INDEX IDX_94A2D4397294869C (article_id), INDEX IDX_94A2D439EC5D4C30 (categorie_article_id), PRIMARY KEY(article_id, categorie_article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_article_photo_categorie (categorie_article_id INT NOT NULL, photo_categorie_id INT NOT NULL, INDEX IDX_91FDFD4CEC5D4C30 (categorie_article_id), INDEX IDX_91FDFD4C339EEE3E (photo_categorie_id), PRIMARY KEY(categorie_article_id, photo_categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, libelle_pays VARCHAR(255) NOT NULL, code_iso2 VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_categorie (id INT AUTO_INCREMENT NOT NULL, description_photo_categorie VARCHAR(255) DEFAULT NULL, photo_categorie LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_adresse (id INT AUTO_INCREMENT NOT NULL, libelle_type_adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816EBC30FB4 FOREIGN KEY (pays_adresse_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081650E40A79 FOREIGN KEY (type_adresse_id) REFERENCES type_adresse (id)');
        $this->addSql('ALTER TABLE article_categorie_article ADD CONSTRAINT FK_94A2D4397294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_categorie_article ADD CONSTRAINT FK_94A2D439EC5D4C30 FOREIGN KEY (categorie_article_id) REFERENCES categorie_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_article_photo_categorie ADD CONSTRAINT FK_91FDFD4CEC5D4C30 FOREIGN KEY (categorie_article_id) REFERENCES categorie_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_article_photo_categorie ADD CONSTRAINT FK_91FDFD4C339EEE3E FOREIGN KEY (photo_categorie_id) REFERENCES photo_categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816EBC30FB4');
        $this->addSql('ALTER TABLE categorie_article_photo_categorie DROP FOREIGN KEY FK_91FDFD4C339EEE3E');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081650E40A79');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE article_categorie_article');
        $this->addSql('DROP TABLE categorie_article_photo_categorie');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE photo_categorie');
        $this->addSql('DROP TABLE type_adresse');
    }
}

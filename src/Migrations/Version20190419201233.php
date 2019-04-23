<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190419201233 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, relation_id INT NOT NULL, type_adresse_id INT NOT NULL, nom_adresse VARCHAR(255) DEFAULT NULL, rue1adresse VARCHAR(255) NOT NULL, rue2adresse VARCHAR(255) DEFAULT NULL, rue3adresse VARCHAR(255) DEFAULT NULL, code_postal_adresse VARCHAR(10) NOT NULL, ville_adresse VARCHAR(255) NOT NULL, INDEX IDX_C35F08163256915B (relation_id), INDEX IDX_C35F081650E40A79 (type_adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, libelle_pays VARCHAR(255) NOT NULL, code_iso2 VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_adresse (id INT AUTO_INCREMENT NOT NULL, libelle_type_adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08163256915B FOREIGN KEY (relation_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081650E40A79 FOREIGN KEY (type_adresse_id) REFERENCES type_adresse (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08163256915B');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081650E40A79');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE type_adresse');
    }
}

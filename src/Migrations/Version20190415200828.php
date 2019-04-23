<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190415200828 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie_article ADD categorie_article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie_article ADD CONSTRAINT FK_5DB9A0C4EC5D4C30 FOREIGN KEY (categorie_article_id) REFERENCES categorie_article (id)');
        $this->addSql('CREATE INDEX IDX_5DB9A0C4EC5D4C30 ON categorie_article (categorie_article_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie_article DROP FOREIGN KEY FK_5DB9A0C4EC5D4C30');
        $this->addSql('DROP INDEX IDX_5DB9A0C4EC5D4C30 ON categorie_article');
        $this->addSql('ALTER TABLE categorie_article DROP categorie_article_id');
    }
}

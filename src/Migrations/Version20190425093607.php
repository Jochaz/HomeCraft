<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425093607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photo_article_blog ADD article_blog_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo_article_blog ADD CONSTRAINT FK_FF3CDF5137323A20 FOREIGN KEY (article_blog_id) REFERENCES article_blog (id)');
        $this->addSql('CREATE INDEX IDX_FF3CDF5137323A20 ON photo_article_blog (article_blog_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photo_article_blog DROP FOREIGN KEY FK_FF3CDF5137323A20');
        $this->addSql('DROP INDEX IDX_FF3CDF5137323A20 ON photo_article_blog');
        $this->addSql('ALTER TABLE photo_article_blog DROP article_blog_id');
    }
}

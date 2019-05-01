<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190501095950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie_article_photo_categorie ADD CONSTRAINT FK_91FDFD4CEC5D4C30 FOREIGN KEY (categorie_article_id) REFERENCES categorie_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_article_photo_categorie ADD CONSTRAINT FK_91FDFD4C339EEE3E FOREIGN KEY (photo_categorie_id) REFERENCES photo_categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045539194ABF FOREIGN KEY (civilite_id) REFERENCES civilite (id)');
        $this->addSql('ALTER TABLE panier DROP nom_panier, CHANGE client_id client_id INT NOT NULL');
        $this->addSql('ALTER TABLE panier RENAME INDEX fk_24cc0df219eb6921 TO IDX_24CC0DF219EB6921');
        $this->addSql('ALTER TABLE panier_article DROP FOREIGN KEY FK_F880CAE77294869C');
        $this->addSql('ALTER TABLE panier_article DROP FOREIGN KEY FK_F880CAE7F77D927C');
        $this->addSql('ALTER TABLE panier_article DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE panier_article ADD quantite INT NOT NULL');
        $this->addSql('ALTER TABLE panier_article ADD CONSTRAINT FK_F880CAE77294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE panier_article ADD CONSTRAINT FK_F880CAE7F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE panier_article ADD PRIMARY KEY (article_id, panier_id)');
        $this->addSql('ALTER TABLE photo_article ADD CONSTRAINT FK_37DA19EB7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE photo_article_blog ADD CONSTRAINT FK_FF3CDF5137323A20 FOREIGN KEY (article_blog_id) REFERENCES article_blog (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie_article_photo_categorie DROP FOREIGN KEY FK_91FDFD4CEC5D4C30');
        $this->addSql('ALTER TABLE categorie_article_photo_categorie DROP FOREIGN KEY FK_91FDFD4C339EEE3E');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045539194ABF');
        $this->addSql('ALTER TABLE panier ADD nom_panier VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier RENAME INDEX idx_24cc0df219eb6921 TO FK_24CC0DF219EB6921');
        $this->addSql('ALTER TABLE panier_article DROP FOREIGN KEY FK_F880CAE77294869C');
        $this->addSql('ALTER TABLE panier_article DROP FOREIGN KEY FK_F880CAE7F77D927C');
        $this->addSql('ALTER TABLE panier_article DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE panier_article DROP quantite');
        $this->addSql('ALTER TABLE panier_article ADD CONSTRAINT FK_F880CAE77294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_article ADD CONSTRAINT FK_F880CAE7F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_article ADD PRIMARY KEY (panier_id, article_id)');
        $this->addSql('ALTER TABLE photo_article DROP FOREIGN KEY FK_37DA19EB7294869C');
        $this->addSql('ALTER TABLE photo_article_blog DROP FOREIGN KEY FK_FF3CDF5137323A20');
    }
}

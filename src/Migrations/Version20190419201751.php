<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190419201751 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08163256915B');
        $this->addSql('DROP INDEX IDX_C35F08163256915B ON adresse');
        $this->addSql('ALTER TABLE adresse CHANGE relation_id pays_adresse_id INT NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816EBC30FB4 FOREIGN KEY (pays_adresse_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_C35F0816EBC30FB4 ON adresse (pays_adresse_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816EBC30FB4');
        $this->addSql('DROP INDEX IDX_C35F0816EBC30FB4 ON adresse');
        $this->addSql('ALTER TABLE adresse CHANGE pays_adresse_id relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08163256915B FOREIGN KEY (relation_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_C35F08163256915B ON adresse (relation_id)');
    }
}

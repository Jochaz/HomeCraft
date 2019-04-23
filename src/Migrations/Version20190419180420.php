<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190419180420 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404557058A30F');
        $this->addSql('DROP INDEX IDX_C74404557058A30F ON client');
        $this->addSql('ALTER TABLE client DROP code_client, CHANGE date_naissance date_naissance DATE NOT NULL, CHANGE email_client email_client VARCHAR(255) NOT NULL, CHANGE code_civilite_id civilite_id INT NOT NULL, CHANGE date_inscription created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045539194ABF FOREIGN KEY (civilite_id) REFERENCES civilite (id)');
        $this->addSql('CREATE INDEX IDX_C744045539194ABF ON client (civilite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045539194ABF');
        $this->addSql('DROP INDEX IDX_C744045539194ABF ON client');
        $this->addSql('ALTER TABLE client ADD code_client VARCHAR(14) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE date_naissance date_naissance DATETIME NOT NULL, CHANGE email_client email_client VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE civilite_id code_civilite_id INT NOT NULL, CHANGE created_at date_inscription DATETIME NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404557058A30F FOREIGN KEY (code_civilite_id) REFERENCES civilite (id)');
        $this->addSql('CREATE INDEX IDX_C74404557058A30F ON client (code_civilite_id)');
    }
}

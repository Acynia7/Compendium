<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250604084235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE related_ressources_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE related_ressources ADD type_id INT DEFAULT NULL, ADD state VARCHAR(255) DEFAULT \'submitted\' NOT NULL');
        $this->addSql('ALTER TABLE related_ressources ADD CONSTRAINT FK_E0E1DD77C54C8C93 FOREIGN KEY (type_id) REFERENCES related_ressources_type (id)');
        $this->addSql('CREATE INDEX IDX_E0E1DD77C54C8C93 ON related_ressources (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE related_ressources DROP FOREIGN KEY FK_E0E1DD77C54C8C93');
        $this->addSql('DROP TABLE related_ressources_type');
        $this->addSql('DROP INDEX IDX_E0E1DD77C54C8C93 ON related_ressources');
        $this->addSql('ALTER TABLE related_ressources DROP type_id, DROP state');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250604084622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE related_ressources ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE related_ressources ADD CONSTRAINT FK_E0E1DD77A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E0E1DD77A76ED395 ON related_ressources (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE related_ressources DROP FOREIGN KEY FK_E0E1DD77A76ED395');
        $this->addSql('DROP INDEX IDX_E0E1DD77A76ED395 ON related_ressources');
        $this->addSql('ALTER TABLE related_ressources DROP user_id');
    }
}

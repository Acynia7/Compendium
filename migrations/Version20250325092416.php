<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250325092416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE celestial_bodies ADD added_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE celestial_bodies ADD CONSTRAINT FK_6DF97BD155B127A4 FOREIGN KEY (added_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6DF97BD155B127A4 ON celestial_bodies (added_by_id)');
        $this->addSql('ALTER TABLE user_search_history ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_search_history ADD CONSTRAINT FK_C1EE4088A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C1EE4088A76ED395 ON user_search_history (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_search_history DROP FOREIGN KEY FK_C1EE4088A76ED395');
        $this->addSql('DROP INDEX IDX_C1EE4088A76ED395 ON user_search_history');
        $this->addSql('ALTER TABLE user_search_history DROP user_id');
        $this->addSql('ALTER TABLE celestial_bodies DROP FOREIGN KEY FK_6DF97BD155B127A4');
        $this->addSql('DROP INDEX IDX_6DF97BD155B127A4 ON celestial_bodies');
        $this->addSql('ALTER TABLE celestial_bodies DROP added_by_id');
    }
}

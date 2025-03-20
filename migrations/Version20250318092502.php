<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250318092502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE celestial_bodies (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, mass DOUBLE PRECISION DEFAULT NULL, radius DOUBLE PRECISION DEFAULT NULL, distance_from_earth DOUBLE PRECISION DEFAULT NULL, temperature DOUBLE PRECISION DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6DF97BD1C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE celestial_body_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorites (id INT AUTO_INCREMENT NOT NULL, celestial_bodies_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E46960F5E2A070DF (celestial_bodies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE related_ressources (id INT AUTO_INCREMENT NOT NULL, celestial_body_id_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E0E1DD77D45E8A10 (celestial_body_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_search_history (id INT AUTO_INCREMENT NOT NULL, query VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE celestial_bodies ADD CONSTRAINT FK_6DF97BD1C54C8C93 FOREIGN KEY (type_id) REFERENCES celestial_body_type (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F5E2A070DF FOREIGN KEY (celestial_bodies_id) REFERENCES celestial_bodies (id)');
        $this->addSql('ALTER TABLE related_ressources ADD CONSTRAINT FK_E0E1DD77D45E8A10 FOREIGN KEY (celestial_body_id_id) REFERENCES celestial_bodies (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE celestial_bodies DROP FOREIGN KEY FK_6DF97BD1C54C8C93');
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F5E2A070DF');
        $this->addSql('ALTER TABLE related_ressources DROP FOREIGN KEY FK_E0E1DD77D45E8A10');
        $this->addSql('DROP TABLE celestial_bodies');
        $this->addSql('DROP TABLE celestial_body_type');
        $this->addSql('DROP TABLE favorites');
        $this->addSql('DROP TABLE related_ressources');
        $this->addSql('DROP TABLE user_search_history');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250404063605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE celestial_bodies CHANGE radius radius VARCHAR(255) DEFAULT NULL, CHANGE distance_from_earth distance_from_earth VARCHAR(255) DEFAULT NULL, CHANGE temperature temperature VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE celestial_bodies CHANGE radius radius DOUBLE PRECISION DEFAULT NULL, CHANGE distance_from_earth distance_from_earth DOUBLE PRECISION DEFAULT NULL, CHANGE temperature temperature DOUBLE PRECISION DEFAULT NULL');
    }
}

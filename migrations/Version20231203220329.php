<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231203220329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode CHANGE season_id season_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE synopsis synopsis LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE episode RENAME INDEX idx_ddaa1cda68756988 TO IDX_DDAA1CDA4EC001D1');
        $this->addSql('ALTER TABLE program ADD country VARCHAR(255) NOT NULL, ADD year INT NOT NULL');
        $this->addSql('ALTER TABLE season RENAME INDEX idx_f0e45ba9e12deda1 TO IDX_F0E45BA93EB8070A');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode CHANGE season_id season_id INT NOT NULL, CHANGE title title VARCHAR(100) NOT NULL, CHANGE synopsis synopsis VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE episode RENAME INDEX idx_ddaa1cda4ec001d1 TO IDX_DDAA1CDA68756988');
        $this->addSql('ALTER TABLE program DROP country, DROP year');
        $this->addSql('ALTER TABLE season RENAME INDEX idx_f0e45ba93eb8070a TO IDX_F0E45BA9E12DEDA1');
    }
}

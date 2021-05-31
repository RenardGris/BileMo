<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524214344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD color VARCHAR(255) NOT NULL, ADD screen_size DOUBLE PRECISION NOT NULL, ADD storage VARCHAR(255) NOT NULL, ADD charger_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD company VARCHAR(255) NOT NULL, ADD phone VARCHAR(15) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP color, DROP screen_size, DROP storage, DROP charger_type');
        $this->addSql('ALTER TABLE user DROP company, DROP phone');
    }
}

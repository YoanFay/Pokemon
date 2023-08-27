<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230825165424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evolution DROP FOREIGN KEY FK_420C2893553A6EC4');
        $this->addSql('DROP INDEX IDX_420C2893553A6EC4 ON evolution');
        $this->addSql('ALTER TABLE evolution DROP generation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evolution ADD generation_id INT NOT NULL');
        $this->addSql('ALTER TABLE evolution ADD CONSTRAINT FK_420C2893553A6EC4 FOREIGN KEY (generation_id) REFERENCES generation (id)');
        $this->addSql('CREATE INDEX IDX_420C2893553A6EC4 ON evolution (generation_id)');
    }
}

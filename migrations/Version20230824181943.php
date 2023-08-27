<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230824181943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evolution (id INT AUTO_INCREMENT NOT NULL, base_pokemon_id INT NOT NULL, evolution_pokemon_id INT NOT NULL, generation_id INT NOT NULL, weather_condition VARCHAR(255) DEFAULT NULL, use_object VARCHAR(255) DEFAULT NULL, hold_object VARCHAR(255) DEFAULT NULL, level INT DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, happiness TINYINT(1) NOT NULL, hour VARCHAR(255) DEFAULT NULL, gender VARCHAR(20) DEFAULT NULL, learn_attack VARCHAR(255) DEFAULT NULL, special LONGTEXT DEFAULT NULL, INDEX IDX_420C2893BC5DCF32 (base_pokemon_id), INDEX IDX_420C2893DD5F0EB3 (evolution_pokemon_id), INDEX IDX_420C2893553A6EC4 (generation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_efficiency (id INT AUTO_INCREMENT NOT NULL, attack_type_id INT NOT NULL, defense_type_id INT NOT NULL, multiplier INT NOT NULL, INDEX IDX_DD6E516C3CF2E074 (attack_type_id), INDEX IDX_DD6E516CD4062971 (defense_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evolution ADD CONSTRAINT FK_420C2893BC5DCF32 FOREIGN KEY (base_pokemon_id) REFERENCES pokemon (id)');
        $this->addSql('ALTER TABLE evolution ADD CONSTRAINT FK_420C2893DD5F0EB3 FOREIGN KEY (evolution_pokemon_id) REFERENCES pokemon (id)');
        $this->addSql('ALTER TABLE evolution ADD CONSTRAINT FK_420C2893553A6EC4 FOREIGN KEY (generation_id) REFERENCES generation (id)');
        $this->addSql('ALTER TABLE type_efficiency ADD CONSTRAINT FK_DD6E516C3CF2E074 FOREIGN KEY (attack_type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE type_efficiency ADD CONSTRAINT FK_DD6E516CD4062971 FOREIGN KEY (defense_type_id) REFERENCES type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evolution DROP FOREIGN KEY FK_420C2893BC5DCF32');
        $this->addSql('ALTER TABLE evolution DROP FOREIGN KEY FK_420C2893DD5F0EB3');
        $this->addSql('ALTER TABLE evolution DROP FOREIGN KEY FK_420C2893553A6EC4');
        $this->addSql('ALTER TABLE type_efficiency DROP FOREIGN KEY FK_DD6E516C3CF2E074');
        $this->addSql('ALTER TABLE type_efficiency DROP FOREIGN KEY FK_DD6E516CD4062971');
        $this->addSql('DROP TABLE evolution');
        $this->addSql('DROP TABLE type_efficiency');
    }
}

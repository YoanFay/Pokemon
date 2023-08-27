<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230826151855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evolution ADD learn_attack_type_id INT DEFAULT NULL, ADD party_type_id INT DEFAULT NULL, ADD party_pokemon_id INT DEFAULT NULL, ADD trade_with_id INT DEFAULT NULL, ADD stats VARCHAR(16) DEFAULT NULL, ADD trade TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE evolution ADD CONSTRAINT FK_420C2893306BA4C8 FOREIGN KEY (learn_attack_type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE evolution ADD CONSTRAINT FK_420C2893D7BD13B8 FOREIGN KEY (party_type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE evolution ADD CONSTRAINT FK_420C2893279CE172 FOREIGN KEY (party_pokemon_id) REFERENCES pokemon (id)');
        $this->addSql('ALTER TABLE evolution ADD CONSTRAINT FK_420C2893318B27E FOREIGN KEY (trade_with_id) REFERENCES pokemon (id)');
        $this->addSql('CREATE INDEX IDX_420C2893306BA4C8 ON evolution (learn_attack_type_id)');
        $this->addSql('CREATE INDEX IDX_420C2893D7BD13B8 ON evolution (party_type_id)');
        $this->addSql('CREATE INDEX IDX_420C2893279CE172 ON evolution (party_pokemon_id)');
        $this->addSql('CREATE INDEX IDX_420C2893318B27E ON evolution (trade_with_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evolution DROP FOREIGN KEY FK_420C2893306BA4C8');
        $this->addSql('ALTER TABLE evolution DROP FOREIGN KEY FK_420C2893D7BD13B8');
        $this->addSql('ALTER TABLE evolution DROP FOREIGN KEY FK_420C2893279CE172');
        $this->addSql('ALTER TABLE evolution DROP FOREIGN KEY FK_420C2893318B27E');
        $this->addSql('DROP INDEX IDX_420C2893306BA4C8 ON evolution');
        $this->addSql('DROP INDEX IDX_420C2893D7BD13B8 ON evolution');
        $this->addSql('DROP INDEX IDX_420C2893279CE172 ON evolution');
        $this->addSql('DROP INDEX IDX_420C2893318B27E ON evolution');
        $this->addSql('ALTER TABLE evolution DROP learn_attack_type_id, DROP party_type_id, DROP party_pokemon_id, DROP trade_with_id, DROP stats, DROP trade');
    }
}

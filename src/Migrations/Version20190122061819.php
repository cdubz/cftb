<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190122061819 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE api_update_log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE race_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE race_day_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE race_entry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE api_update_log (id INT NOT NULL, endpoint VARCHAR(255) NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FF269B7C4420F7B ON api_update_log (endpoint)');
        $this->addSql('CREATE TABLE race (id INT NOT NULL, race_day_id INT NOT NULL, date DATE NOT NULL, number INT NOT NULL, surface VARCHAR(255) NOT NULL, track_condition VARCHAR(255) NOT NULL, updated TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DA6FBBAF63945FF5 ON race (race_day_id)');
        $this->addSql('CREATE TABLE race_day (id INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE race_entry (id INT NOT NULL, race_id INT NOT NULL, horse_name VARCHAR(255) NOT NULL, finish_position INT DEFAULT NULL, also_ran BOOLEAN NOT NULL, scratched BOOLEAN NOT NULL, win_payoff NUMERIC(10, 2) DEFAULT NULL, place_payoff NUMERIC(10, 2) DEFAULT NULL, show_payoff NUMERIC(10, 2) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CD1FBC616E59D40D ON race_entry (race_id)');
        $this->addSql('ALTER TABLE race ADD CONSTRAINT FK_DA6FBBAF63945FF5 FOREIGN KEY (race_day_id) REFERENCES race_day (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE race_entry ADD CONSTRAINT FK_CD1FBC616E59D40D FOREIGN KEY (race_id) REFERENCES race (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE race_entry DROP CONSTRAINT FK_CD1FBC616E59D40D');
        $this->addSql('ALTER TABLE race DROP CONSTRAINT FK_DA6FBBAF63945FF5');
        $this->addSql('DROP SEQUENCE api_update_log_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE race_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE race_day_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE race_entry_id_seq CASCADE');
        $this->addSql('DROP TABLE api_update_log');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE race_day');
        $this->addSql('DROP TABLE race_entry');
    }
}

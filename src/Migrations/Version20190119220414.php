<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190119220414 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE race (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, race_day_id INTEGER NOT NULL, date DATE NOT NULL, number INTEGER NOT NULL, surface VARCHAR(255) NOT NULL, track_condition VARCHAR(255) NOT NULL, updated DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_DA6FBBAF63945FF5 ON race (race_day_id)');
        $this->addSql('CREATE TABLE race_day (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date DATE NOT NULL)');
        $this->addSql('CREATE TABLE race_entry (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, race_id INTEGER NOT NULL, horse_name VARCHAR(255) NOT NULL, finish_position INTEGER DEFAULT NULL, also_ran BOOLEAN NOT NULL, scratched BOOLEAN NOT NULL, win_payoff NUMERIC(10, 2) DEFAULT NULL, place_payoff NUMERIC(10, 2) DEFAULT NULL, show_payoff NUMERIC(10, 2) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_CD1FBC616E59D40D ON race_entry (race_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE race_day');
        $this->addSql('DROP TABLE race_entry');
    }
}

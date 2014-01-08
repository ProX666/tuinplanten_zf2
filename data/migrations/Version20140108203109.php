<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140108203109 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE features ADD plant_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE features ADD CONSTRAINT FK_46B6BE451D935652 FOREIGN KEY (plant_id) REFERENCES Plants (id)");
        $this->addSql("CREATE INDEX IDX_46B6BE451D935652 ON features (plant_id)");
        $this->addSql("ALTER TABLE habitats ADD plant_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE habitats ADD CONSTRAINT FK_4C92F0A51D935652 FOREIGN KEY (plant_id) REFERENCES Plants (id)");
        $this->addSql("CREATE INDEX IDX_4C92F0A51D935652 ON habitats (plant_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE Features DROP FOREIGN KEY FK_46B6BE451D935652");
        $this->addSql("DROP INDEX IDX_46B6BE451D935652 ON Features");
        $this->addSql("ALTER TABLE Features DROP plant_id");
        $this->addSql("ALTER TABLE Habitats DROP FOREIGN KEY FK_4C92F0A51D935652");
        $this->addSql("DROP INDEX IDX_4C92F0A51D935652 ON Habitats");
        $this->addSql("ALTER TABLE Habitats DROP plant_id");
    }
}

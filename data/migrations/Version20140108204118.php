<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140108204118 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE PlantsFeatures (id INT AUTO_INCREMENT NOT NULL, plant_id INT DEFAULT NULL, feature_id INT DEFAULT NULL, INDEX IDX_C6B4F7781D935652 (plant_id), INDEX IDX_C6B4F77860E4B879 (feature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE PlantsHabitats (id INT AUTO_INCREMENT NOT NULL, plant_id INT DEFAULT NULL, habitat_id INT DEFAULT NULL, INDEX IDX_CC90B9981D935652 (plant_id), INDEX IDX_CC90B998AFFE2D26 (habitat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE PlantsFeatures ADD CONSTRAINT FK_C6B4F7781D935652 FOREIGN KEY (plant_id) REFERENCES Plants (id)");
        $this->addSql("ALTER TABLE PlantsFeatures ADD CONSTRAINT FK_C6B4F77860E4B879 FOREIGN KEY (feature_id) REFERENCES Features (id)");
        $this->addSql("ALTER TABLE PlantsHabitats ADD CONSTRAINT FK_CC90B9981D935652 FOREIGN KEY (plant_id) REFERENCES Plants (id)");
        $this->addSql("ALTER TABLE PlantsHabitats ADD CONSTRAINT FK_CC90B998AFFE2D26 FOREIGN KEY (habitat_id) REFERENCES Habitats (id)");
        $this->addSql("ALTER TABLE features DROP FOREIGN KEY FK_46B6BE451D935652");
        $this->addSql("DROP INDEX IDX_46B6BE451D935652 ON features");
        $this->addSql("ALTER TABLE features DROP plant_id");
        $this->addSql("ALTER TABLE habitats DROP FOREIGN KEY FK_4C92F0A51D935652");
        $this->addSql("DROP INDEX IDX_4C92F0A51D935652 ON habitats");
        $this->addSql("ALTER TABLE habitats DROP plant_id");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE PlantsFeatures");
        $this->addSql("DROP TABLE PlantsHabitats");
        $this->addSql("ALTER TABLE Features ADD plant_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE Features ADD CONSTRAINT FK_46B6BE451D935652 FOREIGN KEY (plant_id) REFERENCES plants (id)");
        $this->addSql("CREATE INDEX IDX_46B6BE451D935652 ON Features (plant_id)");
        $this->addSql("ALTER TABLE Habitats ADD plant_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE Habitats ADD CONSTRAINT FK_4C92F0A51D935652 FOREIGN KEY (plant_id) REFERENCES plants (id)");
        $this->addSql("CREATE INDEX IDX_4C92F0A51D935652 ON Habitats (plant_id)");
    }
}

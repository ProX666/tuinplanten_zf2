<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140108122338 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE Habitats (id INT AUTO_INCREMENT NOT NULL, habitat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE PlantsHabitats (id INT AUTO_INCREMENT NOT NULL, plant_id INT DEFAULT NULL, habitat_id INT DEFAULT NULL, INDEX IDX_CC90B9981D935652 (plant_id), INDEX IDX_CC90B998AFFE2D26 (habitat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Uploads (id INT AUTO_INCREMENT NOT NULL, plant_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, filename VARCHAR(255) NOT NULL, filesize INT NOT NULL, filemime VARCHAR(45) NOT NULL, selected TINYINT(1) NOT NULL, INDEX IDX_59AC46841D935652 (plant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE PlantsHabitats ADD CONSTRAINT FK_CC90B9981D935652 FOREIGN KEY (plant_id) REFERENCES Plants (id)");
        $this->addSql("ALTER TABLE PlantsHabitats ADD CONSTRAINT FK_CC90B998AFFE2D26 FOREIGN KEY (habitat_id) REFERENCES Habitats (id)");
        $this->addSql("ALTER TABLE Uploads ADD CONSTRAINT FK_59AC46841D935652 FOREIGN KEY (plant_id) REFERENCES Plants (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE PlantsHabitats DROP FOREIGN KEY FK_CC90B998AFFE2D26");
        $this->addSql("DROP TABLE Habitats");
        $this->addSql("DROP TABLE PlantsHabitats");
        $this->addSql("DROP TABLE Uploads");
    }
}

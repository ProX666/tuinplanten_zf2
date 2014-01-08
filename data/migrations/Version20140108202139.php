<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140108202139 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE plantsfeatures");
        $this->addSql("DROP TABLE plantshabitats");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE plantsfeatures (id INT AUTO_INCREMENT NOT NULL, feature_id INT DEFAULT NULL, plant_id INT DEFAULT NULL, INDEX IDX_C6B4F7781D935652 (plant_id), INDEX IDX_C6B4F77860E4B879 (feature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE plantshabitats (id INT AUTO_INCREMENT NOT NULL, habitat_id INT DEFAULT NULL, plant_id INT DEFAULT NULL, INDEX IDX_CC90B9981D935652 (plant_id), INDEX IDX_CC90B998AFFE2D26 (habitat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE plantsfeatures ADD CONSTRAINT FK_C6B4F77860E4B879 FOREIGN KEY (feature_id) REFERENCES features (id)");
        $this->addSql("ALTER TABLE plantsfeatures ADD CONSTRAINT FK_C6B4F7781D935652 FOREIGN KEY (plant_id) REFERENCES plants (id)");
        $this->addSql("ALTER TABLE plantshabitats ADD CONSTRAINT FK_CC90B998AFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitats (id)");
        $this->addSql("ALTER TABLE plantshabitats ADD CONSTRAINT FK_CC90B9981D935652 FOREIGN KEY (plant_id) REFERENCES plants (id)");
    }
}

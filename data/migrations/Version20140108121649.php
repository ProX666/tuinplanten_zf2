<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140108121649 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE Features (id INT AUTO_INCREMENT NOT NULL, feature VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE PlantsFeatures (id INT AUTO_INCREMENT NOT NULL, plant_id INT DEFAULT NULL, feature_id INT DEFAULT NULL, INDEX IDX_C6B4F7781D935652 (plant_id), INDEX IDX_C6B4F77860E4B879 (feature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE PlantsFeatures ADD CONSTRAINT FK_C6B4F7781D935652 FOREIGN KEY (plant_id) REFERENCES Plants (id)");
        $this->addSql("ALTER TABLE PlantsFeatures ADD CONSTRAINT FK_C6B4F77860E4B879 FOREIGN KEY (feature_id) REFERENCES Features (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE PlantsFeatures DROP FOREIGN KEY FK_C6B4F77860E4B879");
        $this->addSql("DROP TABLE Features");
        $this->addSql("DROP TABLE PlantsFeatures");
    }
}

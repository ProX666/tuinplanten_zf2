<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140108121137 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE Plants (id INT AUTO_INCREMENT NOT NULL, name_id INT DEFAULT NULL, indigenous TINYINT(1) NOT NULL, height INT NOT NULL, origin LONGTEXT DEFAULT NULL, planting_date DATETIME DEFAULT NULL, blooming_start INT NOT NULL, blooming_end INT NOT NULL, details LONGTEXT DEFAULT NULL, present TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_A202D92071179CD6 (name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE Plants ADD CONSTRAINT FK_A202D92071179CD6 FOREIGN KEY (name_id) REFERENCES Names (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE Plants");
    }
}

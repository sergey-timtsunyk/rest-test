<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170723221224 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE `pay_customers` (
              `id` int(20) NOT NULL AUTO_INCREMENT,
              `name` varchar(25) DEFAULT NULL,
              `cnp` varchar(13) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `customer_id_uindex` (`id`),
              UNIQUE KEY `customer_cnp_uindex` (`cnp`),
              UNIQUE KEY `customer_name_cnp_uindex` (`name`,`cnp`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("DROP TABLE `pay_customers`");
    }
}

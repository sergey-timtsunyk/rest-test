<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170723222452 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE `pay_transactions` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `customer_id` int(11) DEFAULT NULL,
              `amount` decimal(11,2) NOT NULL,
              `date` datetime NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `transaction_id_uindex` (`id`),
              KEY `transaction_customer_id_fk` (`customer_id`),
              KEY `pay_transactions_amount_index` (`amount`),
              KEY `pay_transactions_date_index` (`date`),
              KEY `transaction_amount_date_uindex` (`amount`,`date`),
              CONSTRAINT `transaction_customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `pay_customers` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("DROP TABLE `pay_transactions`");
    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170723221225 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE `pay_count_transaction` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `sum` decimal(10,0) NOT NULL,
              `date` date NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `pay_count_transaction_id_uindex` (`id`),
              UNIQUE KEY `pay_count_transaction_date_uindex` (`date`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("DROP TABLE `pay_count_transaction`");
    }
}

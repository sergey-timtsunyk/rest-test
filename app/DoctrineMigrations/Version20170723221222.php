<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170723221222 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE `oauth2_auth_codes` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `clitnt_id` int(11) NOT NULL,
              `user_id` int(11) DEFAULT NULL,
              `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `redirect_uri` longtext COLLATE utf8_unicode_ci NOT NULL,
              `expires_at` int(11) DEFAULT NULL,
              `scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `UNIQ_A018A10D5F37A13B` (`token`),
              KEY `IDX_A018A10DD161B81F` (`clitnt_id`),
              KEY `IDX_A018A10DA76ED395` (`user_id`),
              CONSTRAINT `FK_A018A10DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
              CONSTRAINT `FK_A018A10DD161B81F` FOREIGN KEY (`clitnt_id`) REFERENCES `oauth2_clients` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("DROP TABLE `oauth2_auth_codes`");
    }
}

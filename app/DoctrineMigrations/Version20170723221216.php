<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170723221216 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE `users` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
              `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
              `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
              `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
              `enabled` tinyint(1) NOT NULL,
              `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
              `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `last_login` datetime DEFAULT NULL,
              `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
              `password_requested_at` datetime DEFAULT NULL,
              `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
              PRIMARY KEY (`id`),
              UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
              UNIQUE KEY `UNIQ_1483A5E9A0D96FBF` (`email_canonical`),
              UNIQUE KEY `UNIQ_1483A5E9C05FB297` (`confirmation_token`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("DROP TABLE `users`");
    }
}

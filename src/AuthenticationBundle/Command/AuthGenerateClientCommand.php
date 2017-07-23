<?php

namespace AuthenticationBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AuthGenerateClientCommand extends ContainerAwareCommand
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    protected function configure()
    {
        $this
            ->setName('auth:generate:client')
            ->setDescription('Create client for OAuth2 authentication')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->init();
        $clientId = hash('sha256', mt_rand(0, 15));
        $clientSecret = hash('sha256', mt_rand(15, 25));

        $stmt = $this->entityManager->getConnection()->prepare(
            'INSERT INTO `oauth2_clients` VALUES (NULL, :client_id, :redirect_uris, :client_secret, :allowed_grant_types)'
        );
        $stmt->execute([
            'client_id' => $clientId,
            'redirect_uris' => 'a:0:{}',
            'client_secret' => $clientSecret,
            'allowed_grant_types' => 'a:1:{i:0;s:8:"password";}'
        ]);
        $id = $this->entityManager->getConnection()->lastInsertId();

        $output->writeln('Start.');
        $output->writeln(sprintf('client_id: [%s_%s]', $id, $clientId));
        $output->writeln(sprintf('client_secret: [%s]', $clientSecret));
        $output->writeln('Command result.');
    }

    private function init()
    {
        $this->entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
    }

}

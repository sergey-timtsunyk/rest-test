<?php

namespace PaymentBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use PaymentBundle\Entity\CountTransaction;
use PaymentBundle\Entity\Transaction;
use PaymentBundle\Persistent\CountTransactionRepository;
use PaymentBundle\Persistent\TransactionRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CountSumTransactionAtDayCommand extends ContainerAwareCommand
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * @var CountTransactionRepository
     */
    private $countTransactionRepository;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('pay:count-sum-transaction-day')
            ->setDescription('Count sum transaction at day. As default count current day.')
            ->addOption('day', null, InputOption::VALUE_OPTIONAL, 'Set day for count, format d.m.Y')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->init();
        $date = new \DateTime($input->getOption('day') ?: 'now');
        $sum = $this->getSumTransaction($date);
        $this->saveCountTransaction($date, $sum);

        $output->writeln('Command result.');
        $output->writeln(sprintf('%s: %.2f', $date->format('d.m.Y'), $sum));
    }

    /**
     * @param \DateTime $date
     *
     * @return float
     */
    private function getSumTransaction(\DateTime $date) : float
    {
        return $this->transactionRepository->sumByDate($date);
    }

    /**
     * @param \DateTime $date
     * @param float $sum
     */
    private function saveCountTransaction(\DateTime $date, float $sum)
    {
        $countTransaction = $this->countTransactionRepository->findOneBy(
            ['date' => new \DateTime($date->format('d.m.Y'))]
        );

        if ($countTransaction instanceof CountTransaction) {
            $countTransaction->setSum($sum);
        } else {
            $countTransaction = new CountTransaction();
            $countTransaction->setSum($sum);
            $countTransaction->setDate($date);
        }

        $this->entityManager->persist($countTransaction);
        $this->entityManager->flush();

    }

    private function init()
    {
        $this->entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->transactionRepository = $this->entityManager->getRepository(Transaction::class);
        $this->countTransactionRepository = $this->entityManager->getRepository(CountTransaction::class);
    }
}

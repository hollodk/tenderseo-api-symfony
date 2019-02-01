<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TenderSEO\Client;

class StatusCommand extends Command
{
    protected static $defaultName = 'app:status';

    protected function configure()
    {
        $this
            ->setDescription('Get your user status')
            ->addArgument('key', InputArgument::OPTIONAL, 'Api key')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client([
            'key' => $input->getArgument('key'),
            'test' => true,
        ]);

        $result = $client->status();
        dump($result);
    }
}

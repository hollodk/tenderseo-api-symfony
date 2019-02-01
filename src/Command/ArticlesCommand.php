<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TenderSEO\Client;

class ArticlesCommand extends Command
{
    protected static $defaultName = 'app:articles';

    protected function configure()
    {
        $this
            ->setDescription('Get all articles in your account at tenderseo.com')
            ->addArgument('key', InputArgument::OPTIONAL, 'Api key')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client([
            'key' => $input->getArgument('key'),
            'test' => true,
        ]);

        $result = $client->getArticles([
            'language' => null,
            'tag' => null,
            'from' => '2019-01-31 15:31:16',
        ]);
        dump($result);
    }
}

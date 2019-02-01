<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleCommand extends Command
{
    protected static $defaultName = 'app:article';

    protected function configure()
    {
        $this
            ->setDescription('Get article from tenderseo.com')
            ->addArgument('key', InputArgument::REQUIRED, 'Api key')
            ->addArgument('uuid', InputArgument::REQUIRED, 'Article uuid')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new \App\Client([
            'key' => $input->getArgument('key'),
            'test' => true,
        ]);

        $result = $client->getArticle([
            'uuid' => $input->getArgument('uuid'),
        ]);
        dump($result);
    }
}

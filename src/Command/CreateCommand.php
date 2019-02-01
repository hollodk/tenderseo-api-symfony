<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateCommand extends Command
{
    protected static $defaultName = 'app:create';

    protected function configure()
    {
        $this
            ->setDescription('Create a new article at tenderseo')
            ->addArgument('key', InputArgument::OPTIONAL, 'Api key')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new \App\Client([
            'key' => $input->getArgument('key'),
            'test' => true,
        ]);

        $result = $client->createArticle([
            'language' => 'english',
            'keywords' => 'car, blue',
            'words' => 50,
            'tag' => 'test',
            'test' => true, // order will not be processed
        ]);
        dump($result);

        if (isset($result->uuid)) {
            $result = $client->getOrder([
                'uuid' => $result->uuid
            ]);
            dump($result);
        }
    }
}

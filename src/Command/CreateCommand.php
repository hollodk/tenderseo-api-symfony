<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TenderSEO\Client;

class CreateCommand extends Command
{
    protected static $defaultName = 'app:create';

    protected function configure()
    {
        $this
            ->setDescription('Create a new article at tenderseo')
            ->addArgument('key', InputArgument::OPTIONAL, 'Api key')
            ->addArgument('type', InputArgument::OPTIONAL, 'Article or translation')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client([
            'key' => $input->getArgument('key'),
            'test' => true,
        ]);

        if ($input->getArgument('type') == 'translation') {
            dump('create translation');

            $result = $client->createArticle([
                'source_language' => 'english',
                'language' => 'danish',
                'service' => 'translation',
                'tag' => 'test',
                'article' => 'Hi, how are you today?',
                'test' => true, // order will not be processed
            ]);

        } else {
            dump('create article');

            $result = $client->createArticle([
                'language' => 'english',
                'keywords' => 'car, blue',
                'service' => 'article',
                'words' => 50,
                'tag' => 'test',
                'test' => true, // order will not be processed
            ]);
        }

        dump($result);

        if (isset($result->uuid)) {
            $result = $client->order([
                'uuid' => $result->uuid
            ]);
            dump($result);
        }
    }
}

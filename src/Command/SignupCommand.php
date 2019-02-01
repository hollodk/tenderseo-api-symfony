<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SignupCommand extends Command
{
    protected static $defaultName = 'app:signup';

    protected function configure()
    {
        $this
            ->setDescription('Signup with a new account at tenderseo')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new \App\Client([
            'test' => true,
        ]);

        $result = $client->signup([
            'email' => 'user@example.com',
            'name' => 'John Doe',
        ]);
        dump($result);
    }
}

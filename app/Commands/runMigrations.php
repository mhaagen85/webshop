<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Core\Database;

/**
 * Run migrations command
 */
class runMigrations extends Command
{
    protected $commandName = 'database:migrate';
    protected $commandDescription = "Run Migrations";

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('Do you want to run the migrations?', false);

        if (!$helper->ask($input, $output, $question)) {
            return Command::SUCCESS;
        }
        // Run Migrations
        $db = new Database();
        $db->applyMigrations();

        $output->writeln('migrations applied');

        return true;
    }
}
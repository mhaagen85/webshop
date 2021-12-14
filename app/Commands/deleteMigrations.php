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
 * Delete migrations command
 */
class deleteMigrations extends Command
{
    protected $commandName = 'database:delete';
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
        $question = new ConfirmationQuestion('Do you want to delete the migrations?', false);

        if (!$helper->ask($input, $output, $question)) {
            return Command::SUCCESS;
        }
        // Delete Migrations
        $db = new Database();
        $db->deleteMigrations();

        $output->writeln('migrations deleted');

        return true;
    }
}
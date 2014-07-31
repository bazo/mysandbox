<?php

namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;



/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class CreateUser extends Command
{

	protected function configure()
	{
		$this
				->setName('app:user:create')
				->setDescription('Creates a user')
				->addArgument('login', InputArgument::OPTIONAL, 'login?')
				->addArgument('password', InputArgument::OPTIONAL, 'password?')
		;
	}


	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('creating new user...');

		$login = $input->getArgument('login');
		$password = $input->getArgument('password');

		if ($login !== NULL and $password !== NULL) {
			goto create;
		}
		$dialog = new QuestionHelper;
		$loginQuestion = new Question('please provide login for the new user: ');
		$passwordQuestion = new Question(sprintf('please provide password for the user %s: ', $login));
		$passwordQuestion->setHidden(TRUE);

		if ($login === null) {
			$login = $dialog->ask($input, $output, $loginQuestion);

			if ($login === null) {
				$output->writeln('<error>you have to provide login. aborting.</error>');
				return;
			}

			$password = $dialog->ask($input, $output, $passwordQuestion);

			if ($password === null) {
				$output->writeln('<error>you have to provide password. aborting.</error>');
				return;
			}
		}

		if ($login !== null and $password === null) {

			$password = $dialog->ask($input, $output, $passwordQuestion);
			if ($password === null) {
				$output->writeln('<error>you have to provide password. aborting.</error>');
				return;
			}
		}

		create:

		if ($this->dm->getRepository('User')->findOneBy(['login' => $login]) !== null) {
			$output->writeln('<error>user with login ' . $login . ' already exists. aborting.</error>');
			return;
		}

		$hash = password_hash($password, PASSWORD_BCRYPT);

		$output->writeln('<info>user ' . $login . ' succesfully created</info>');
	}


}
<?php

namespace Console\Command;

use Symfony\Component\Console;



/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Install extends Console\Command\Command
{

	protected function configure()
	{
		$this
				->setName('app:install')
				->setDescription('Installs app')
		;
	}


	protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
	{
		$output->writeln('Installing app');
		$application = $this->getApplication();


		$output->writeln('Finished');
	}


}
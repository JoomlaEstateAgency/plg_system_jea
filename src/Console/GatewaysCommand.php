<?php

namespace Joomla\Plugin\System\Jea\Console;

use Joomla\CMS\Factory;
use Joomla\Console\Command\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

require_once JPATH_ADMINISTRATOR . '/components/com_jea/gateways/dispatcher.php';

/**
 * This command runs JEA gateways jobs
 */
abstract class GatewaysCommand extends AbstractCommand
{
	protected $task = '';

	/**
	 * Entry point for CLI script
	 *
	 * @return integer the parents result
	 */
	protected function doExecute(InputInterface $input, OutputInterface $output): int
	{
		Factory::getApplication()->getLanguage()->load('com_jea', JPATH_ADMINISTRATOR . '/components/com_jea');
		$dispatcher = \GatewaysEventDispatcher::getInstance();
		$dispatcher->loadGateways();
		$dispatcher->trigger($this->task);

		return 0;
	}

	/**
	 * Configure the command.
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	protected function configure(): void
	{
		$help = "<info>%command.name%</info> Execute JEA gateways {$this->task} jobs
		\nUsage: <info>php %command.full_name%</info>";
		$this->setDescription('Run JEA gateways ' . $this->task . ' jobs');
		$this->setHelp($help);
	}
}

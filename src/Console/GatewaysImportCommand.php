<?php

namespace Joomla\Plugin\System\Jea\Console;

/**
 * This command runs JEA gateways export jobs
 */
class GatewaysImportCommand extends GatewaysCommand
{
	protected static $defaultName = 'jea:gateways:import';

	/**
	 * Configure the command.
	 *
	 * @return  void
	 */
	protected function configure(): void
	{
		$this->task = 'import';

		parent::configure();
	}
}

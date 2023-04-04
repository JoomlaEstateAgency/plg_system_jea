<?php

namespace Joomla\Plugin\System\Jea\Console;

/**
 * This command runs JEA gateways export jobs
 */
class GatewaysExportCommand extends GatewaysCommand
{
	protected static $defaultName = 'jea:gateways:export';

	/**
	 * Configure the command.
	 *
	 * @return  void
	 */
	protected function configure(): void
	{
		$this->task = 'export';

		parent::configure();
	}
}

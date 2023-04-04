<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  System.Jea
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\SubscriberInterface;
use Joomla\Application\ApplicationEvents;
use Joomla\CMS\Console\Loader\WritableLoaderInterface;
use Joomla\Plugin\System\Jea\Console\GatewaysExportCommand;
use Joomla\Plugin\System\Jea\Console\GatewaysImportCommand;

defined('_JEXEC') or die;

/**
 * Joomla! Jea plugin.
 *
 */
class PlgSystemJea extends CMSPlugin implements SubscriberInterface
{

	/**
	 * Returns an array of events this subscriber will listen to.
	 *
	 * @return  array
	 *
	 * @since   4.1.3
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			ApplicationEvents::BEFORE_EXECUTE => 'registerCommands',
		];
	}

	public function registerCommands(): void
	{
		$container = Factory::getContainer();
		$writableLoader = $container->get(WritableLoaderInterface::class);
		assert($writableLoader instanceof WritableLoaderInterface);

		$container->share(
			GatewaysExportCommand::class,
			function () {
				return new GatewaysExportCommand();
			},
			true,
		);

		$container->share(
			GatewaysImportCommand::class,
			function () {
				return new GatewaysImportCommand();
			},
			true,
		);

		$writableLoader->add('jea:gateways:export', GatewaysExportCommand::class);
		$writableLoader->add('jea:gateways:import', GatewaysImportCommand::class);
	}
}

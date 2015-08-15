<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) 2015 David Yang <daworld.ny@gmail.com>
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Application\Component;

use RuntimeException;
use Krystal\Db\Sql\SqlDbConnectorFactory;
use Krystal\InstanceManager\DependencyInjectionContainerInterface;
use Krystal\Application\InputInterface;

final class Db implements ComponentInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function getInstance(DependencyInjectionContainerInterface $container, array $config, InputInterface $input)
	{
		if (isset($config['components']['db'])) {
			$db = $config['components']['db'];

			// Prepared connection instances
			$instances = array();
			$factory = new SqlDbConnectorFactory($container->get('paginator'));

			foreach ($db as $name => $data) {

				if (!isset($data['connection']) || !is_array($data['connection'])) {
					throw new RuntimeException('No database configuration provided');
				}

				$instances[$name] = $factory->build($name, $data['connection']);
			}

			return $instances;
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName()
	{
		return 'db';
	}
}

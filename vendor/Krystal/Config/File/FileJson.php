<?php/** * This file is part of the Krystal Framework *  * Copyright (c) 2015 David Yang <daworld.ny@gmail.com> *  * For the full copyright and license information, please view * the license file that was distributed with this source code. */namespace Krystal\Config;use LogicException;final class FileJson extends FileAbstract{	/**	 * {@inheritDoc}	 */	protected function render()	{		return json_encode($this->config, true);	}	/**	 * {@inheritDoc}	 */	protected function fetch()	{		$json = file_get_contents($this->path);		if ($json !== false) {			return json_decode($json, true);		} else {			throw new LogicException(sprintf('Cannot read a file at "%s"', $this->path));		}	}}
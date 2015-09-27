<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Http;

/**
 * Most of the definitions was taken from CodeIgniter
 */
final class Agent implements AgentInterface
{
	/**
	 * Robots
	 * 
	 * @var array
	 */
	private $robots = array(
		'googlebot'			=> 'Googlebot',
		'msnbot'			=> 'MSNBot',
		'slurp'				=> 'Inktomi Slurp',
		'yahoo'				=> 'Yahoo',
		'askjeeves'			=> 'AskJeeves',
		'fastcrawler'		=> 'FastCrawler',
		'infoseek'			=> 'InfoSeek Robot 1.0',
		'lycos'				=> 'Lycos'
	);

	/**
	 * Mobile definitions
	 * 
	 * @var array
	 */
	private $mobiles = array(
		'mobileexplorer'    => 'Mobile Explorer',
		'palmsource'        => 'Palm',
		'palmscape'         => 'Palmscape',

		// Phones and Manufacturers
		'motorola'          => "Motorola",
		'nokia'             => "Nokia",
		'palm'              => "Palm",
		'iphone'            => "Apple iPhone",
		'ipod'              => "Apple iPod Touch",
		'sony'              => "Sony Ericsson",
		'ericsson'          => "Sony Ericsson",
		'blackberry'        => "BlackBerry",
		'cocoon'            => "O2 Cocoon",
		'blazer'            => "Treo",
		'lg'                => "LG",
		'amoi'              => "Amoi",
		'xda'               => "XDA",
		'mda'               => "MDA",
		'vario'             => "Vario",
		'htc'               => "HTC",
		'samsung'           => "Samsung",
		'sharp'             => "Sharp",
		'sie-'              => "Siemens",
		'alcatel'           => "Alcatel",
		'benq'              => "BenQ",
		'ipaq'              => "HP iPaq",
		'mot-'              => "Motorola",
		'playstation portable'  => "PlayStation Portable",
		'hiptop'            => "Danger Hiptop",
		'nec-'              => "NEC",
		'panasonic'         => "Panasonic",
		'philips'           => "Philips",
		'sagem'             => "Sagem",
		'sanyo'             => "Sanyo",
		'spv'               => "SPV",
		'zte'               => "ZTE",
		'sendo'             => "Sendo",

		// Operating Systems
		'symbian'           => "Symbian",
		'SymbianOS'         => "SymbianOS",
		'elaine'            => "Palm",
		'palm'              => "Palm",
		'series60'          => "Symbian S60",
		'windows ce'        => "Windows CE",

		// Browsers
		'obigo'             => "Obigo",
		'netfront'          => "Netfront Browser",
		'openwave'          => "Openwave Browser",
		'mobilexplorer'     => "Mobile Explorer",
		'operamini'         => "Opera Mini",
		'opera mini'        => "Opera Mini",

		// Other
		'digital paths'     => "Digital Paths",
		'avantgo'           => "AvantGo",
		'xiino'             => "Xiino",
		'novarra'           => "Novarra Transcoder",
		'vodafone'          => "Vodafone",
		'docomo'            => "NTT DoCoMo",
		'o2'                => "O2",

		// Fallback
		'mobile'            => "Generic Mobile",
		'wireless'          => "Generic Mobile",
		'j2me'              => "Generic Mobile",
		'midp'              => "Generic Mobile",
		'cldc'              => "Generic Mobile",
		'up.link'           => "Generic Mobile",
		'up.browser'        => "Generic Mobile",
		'smartphone'        => "Generic Mobile",
		'cellphone'         => "Generic Mobile"
	);

	/**
	 * Browsers
	 * 
	 * @var array
	 */
	private $browsers = array(
		'Flock'             => 'Flock',
		'Chrome'            => 'Chrome',
		'Opera'             => 'Opera',
		'MSIE'              => 'Internet Explorer',
		'Internet Explorer' => 'Internet Explorer',
		'ipad'              => "iPad",
		'Shiira'            => 'Shiira',
		'Firefox'           => 'Firefox',
		'Chimera'           => 'Chimera',
		'Phoenix'           => 'Phoenix',
		'Firebird'          => 'Firebird',
		'Camino'            => 'Camino',
		'Netscape'          => 'Netscape',
		'OmniWeb'           => 'OmniWeb',
		'Safari'            => 'Safari',
		'Mozilla'           => 'Mozilla',
		'Konqueror'         => 'Konqueror',
		'icab'              => 'iCab',
		'Lynx'              => 'Lynx',
		'Links'             => 'Links',
		'hotjava'           => 'HotJava',
		'amaya'             => 'Amaya',
		'IBrowse'           => 'IBrowse',		
	);

	/**
	 * Platform definitions
	 * 
	 * @var array
	 */
	private $platforms = array(
		'windows nt 6.0'    => 'Windows Longhorn',
		'windows nt 5.2'    => 'Windows 2003',
		'windows nt 5.0'    => 'Windows 2000',
		'windows nt 5.1'    => 'Windows XP',
		'windows nt 4.0'    => 'Windows NT 4.0',
		'winnt4.0'          => 'Windows NT 4.0',
		'winnt 4.0'         => 'Windows NT',
		'winnt'             => 'Windows NT',
		'windows 98'        => 'Windows 98',
		'win98'             => 'Windows 98',
		'windows 95'        => 'Windows 95',
		'win95'             => 'Windows 95',
		'windows'           => 'Unknown Windows OS',
		'os x'              => 'Mac OS X',
		'ppc mac'           => 'Power PC Mac',
		'freebsd'           => 'FreeBSD',
		'ppc'               => 'Macintosh',
		'linux'             => 'Linux',
		'debian'            => 'Debian',
		'sunos'             => 'Sun Solaris',
		'beos'              => 'BeOS',
		'apachebench'       => 'ApacheBench',
		'aix'               => 'AIX',
		'irix'              => 'Irix',
		'osf'               => 'DEC OSF',
		'hp-ux'             => 'HP-UX',
		'netbsd'            => 'NetBSD',
		'bsdi'              => 'BSDi',
		'openbsd'           => 'OpenBSD',
		'gnu'               => 'GNU/Linux',
		'unix'              => 'Unknown Unix OS'		
	);

	/**
	 * Return robots
	 * 
	 * @return array
	 */
	public function getRobots()
	{
		return $this->robots;
	}

	/**
	 * Return browsers
	 * 
	 * @return array
	 */
	public function getBrowsers()
	{
		return $this->browsers;
	}

	/**
	 * Return platforms
	 * 
	 * @return array
	 */
	public function getPlatforms()
	{
		return $this->platforms;
	}
}

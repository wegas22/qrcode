<?php

/**
 * @copyright	Copyright (c) 2023 WEGAS. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * system - qrcode Plugin
 *
 * @package		Joomla.Plugin
 * @subpakage	WEGAS.qrcode
 */
class plgsystemqrcode extends JPlugin
{

	/**
	 * Constructor.
	 *
	 * @param 	$subject
	 * @param	array $config
	 */
	function __construct(&$subject, $config = array())
	{

		if (isset($_GET['plugin'])) {
			if ($_GET['plugin'] == 'qrcode') {
				if ($config['params']) {
					$link = json_decode($config['params']);

					// Проверяем, является ли устройство мобильным
					if (preg_match('/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i', $_SERVER['HTTP_USER_AGENT'])) {
						// Определяем операционную систему устройства
						if (preg_match('/iPhone|iPad|iPod/i', $_SERVER['HTTP_USER_AGENT'])) {
							// Если iOS
							header('Location: ' . $link->ios);
							exit;
						} else if (preg_match('/Android/i', $_SERVER['HTTP_USER_AGENT'])) {
							// Если Android
							header('Location: ' . $link->android);
							exit;
						} else {
							// Если другая мобильная ОС, например, вход с ПК
							// Здесь можно перенаправить на другой маркет или страницу с инструкцией по установке приложения
							die("К сожалению, ваша операционная система не поддерживается");
						}
					} else {
						// Если другая мобильная ОС, например, вход с ПК
						// Здесь можно перенаправить на другой маркет или страницу с инструкцией по установке приложения
						die("К сожалению, ваша операционная система не поддерживается");
					}
				}
			}
		}


		parent::__construct($subject, $config);
	}
}

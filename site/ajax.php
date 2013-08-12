<?php defined('_JEXEC') or die;

/**
 * File       ajax.php
 * Created    5/20/13 4:54 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/Joomla-Ajax-Interface/issues
 * Copyright  Copyright (C) 2013 betweenbrain llc. All Rights Reserved.
 * License    GNU General Public License version 2, or later.
 */

// Reference global application object
$app = JFactory::getApplication();

// JInput object
$input = JFactory::getApplication()->input;

// Requested format passed via URL
$format = strtolower($input->get('format'));

// Initialized to prevent notice in case someone tries to access directly
$results = '';

/*
 * Module support is via the module helper file.
 *
 * By default, the getAjax method of the modFooHelper class will be called,
 * where foo is the value of the module variable passed via the URL
 * (i.e. index.php?option=com_ajax&module=foo).
 *
 * Optionally pass values for the 'helper' file, 'class', and 'method' names.
 *
 */
//TODO: Investigate using JInput and possible deprecation of getVar.
if ($input->get('module')) {
	$module = $input->get('module');
	$helper = $input->get('helper', 'helper');
	$class  = $input->get('class', 'mod' . ucfirst($module) . 'Helper');
	$method = $input->get('method', 'getAjax');

	require_once(JPATH_ROOT . '/modules/mod_' . $module . '/' . $helper . '.php');
	$results = $class::$method($params);
}

/*
 * Plugin support is based on the "Ajax" plugin group.
 *
 * The plugin event triggered is onAjaxFoo, where foo is the value of the
 * 'plugin' variable passed via the URL (i.e. index.php?option=com_ajax&plugin=foo)
 *
 */
if ($input->get('plugin')) {
	JPluginHelper::importPlugin('ajax');
	$plugin     = ucfirst($input->get('plugin'));
	$dispatcher = JDispatcher::getInstance();
	$results    = $dispatcher->trigger('onAjax' . $plugin);
}

// Return the results in the desired format
switch ($format) {
	case 'json':
		echo json_encode($results);
		$app->close();
		break;
	case 'debug':
		echo '<pre>' . print_r($results, TRUE) . '</pre>';
		$app->close();
		break;
	default:
		echo is_array($results) ? implode($results) : $results;
		// Emulates format=raw by closing $app
		$app->close();
		break;
}

/*
 * References
 *  Support plugins in your component
 * - http://docs.joomla.org/Supporting_plugins_in_your_component
 *
 * Best way for JSON output
 * - https://groups.google.com/d/msg/joomla-dev-cms/WsC0nA9Fixo/Ur-gPqpqh-EJ
 *
 */

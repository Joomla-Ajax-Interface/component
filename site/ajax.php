<?php defined('_JEXEC') or die;

/**
 * File       ajax.php
 * Created    5/20/13 4:54 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2013 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v3 or later
 */

// Reference global application object
$app = JFactory::getApplication();

// Instantiate the JDispatcher class
$dispatcher = JDispatcher::getInstance();

// Format passed via URL
$format = strtolower(JRequest::getVar('format'));

// Ajax plugin group to fire
$group = ucfirst(JRequest::getVar('group'));

// Import Ajax plugin group
JPluginHelper::importPlugin('ajax');

// Trigger custom event
$results = $dispatcher->trigger('onAjax' . $group);

// Return the results from this plugin group in the desired format
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
		foreach ($results as $result) {
			if (is_array($result)) {
				echo implode($result);
			} else {
				echo $result;
			}
		};
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

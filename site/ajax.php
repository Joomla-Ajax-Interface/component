<?php defined('_JEXEC') or die;

/**
 * File       ajax.php
 * Created    5/20/13 4:54 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2013 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v3 or later
 */

// Ajax plugin group to fire
$group = ucfirst(JRequest::getVar('group'));

// Import plugin group
JPluginHelper::importPlugin('ajax');

// Instantiate the JDispatcher class
$dispatcher = JDispatcher::getInstance();

// Trigger custom event
// TODO: capture parameters from the URL
$results = $dispatcher->trigger('onAjax' . $group, array(& $item, & $item->params, 0));

// Return the results of the plugins in tis group
return $results;


/*
 * References
 * - http://docs.joomla.org/Supporting_plugins_in_your_component
 */
<?php

/**
 * File			script.php
 * Created		8/11/13 10:55 PM 
 * Author		Matt Thomas matt@betweenbrain.com
 * Copyright	Copyright (C) 2013 betweenbrain llc. 
 */

/**
 * Installation class to perform additional changes during install/uninstall/update
 *
 * @package  Ajax
 * @since    3.0
 */
class Com_AjaxInstallerScript
{
	/**
	 * An array of supported database types
	 *
	 * @var    array
	 * @since  3.0
	 */
	protected $dbSupport = array('mysql', 'mysqli', 'postgresql', 'sqlsrv', 'sqlazure');

	/**
	 * Function to act after the installation process runs
	 *
	 * @param   string             $type     The action being performed
	 * @param   JInstallerPackage  $parent   The class calling this method
	 * @param   array              $results  The results of each installer action
	 *
	 * @return	void
	 *
	 * @since	3.0
	 */
	public function postflight($type, $parent)
	{

		// Get a db connection.
		$db = JFactory::getDbo();

		// Create a new query object.
		$query = $db->getQuery(true);

		//Build the query
		$query
			->delete($db->quoteName('#__menu'))
			->where('title LIKE \'com_ajax\'');
		$db->setQuery($query);

		//execute db object
		try {
		// Execute the query
		$results = $db->execute();
		} catch (Exception $e) {
		//print the errors
		echo $e->getMessage();
		}
	}
}

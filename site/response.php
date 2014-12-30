<?php
/**
 * File       ajax.php
 * Created    12/30/14 4:54 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/Joomla-Ajax-Interface/issues
 * Copyright  Copyright (C) 2013 betweenbrain llc. All Rights Reserved.
 * License    GNU General Public License version 2, or later.
 */

defined('JPATH_PLATFORM') or die;

/**
 * JSON Response class.
 *
 * This class serves to provide the Joomla Platform with a common interface to access
 * response variables for e.g. Ajax requests.
 *
 * @since  2.0
 */
class JResponseJson
{
	/**
	 * Determines whether the request was successful
	 *
	 * @var    boolean
	 * @since  2.0
	 */
	public $success = true;

	/**
	 * The main response message
	 *
	 * @var    string
	 * @since  2.0
	 */
	public $message = null;

	/**
	 * Array of messages gathered in the JApplication object
	 *
	 * @var    array
	 * @since  2.0
	 */
	public $messages = null;

	/**
	 * The response data
	 *
	 * @var    mixed
	 * @since  2.0
	 */
	public $data = null;

	/**
	 * Constructor
	 *
	 * @param   mixed    $response        The Response data
	 * @param   string   $message         The main response message
	 * @param   boolean  $error           True, if the success flag shall be set to false, defaults to false
	 * @param   boolean  $ignoreMessages  True, if the message queue shouldn't be included, defaults to false
	 *
	 * @since   2.0
	 */
	public function __construct($response = null, $message = null, $error = false, $ignoreMessages = false)
	{
		$this->message = $message;

		// Get the message queue if requested and available
		$app = JFactory::getApplication();

		if (!$ignoreMessages && !is_null($app) && is_callable(array($app, 'getMessageQueue')))
		{
			$messages = $app->getMessageQueue();

			// Build the sorted messages list
			if (is_array($messages) && count($messages))
			{
				foreach ($messages as $message)
				{
					if (isset($message['type']) && isset($message['message']))
					{
						$lists[$message['type']][] = $message['message'];
					}
				}
			}

			// If messages exist add them to the output
			if (isset($lists) && is_array($lists))
			{
				$this->messages = $lists;
			}
		}

		// Check if we are dealing with an error
		if ($response instanceof Exception)
		{
			// Prepare the error response
			$this->success	= false;
			$this->message	= $response->getMessage();
		}
		else
		{
			// Prepare the response data
			$this->success	= !$error;
			$this->data			= $response;
		}
	}

	/**
	 * Magic toString method for sending the response in JSON format
	 *
	 * @return  string  The response in JSON format
	 *
	 * @since   2.0
	 */
	public function __toString()
	{
		return json_encode($this);
	}
}

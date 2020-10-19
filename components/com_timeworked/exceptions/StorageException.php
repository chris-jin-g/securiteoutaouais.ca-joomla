<?php
defined('_JEXEC') or die;
/**
 * Class Database Storage Exception
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
class StorageException extends Exception
{
	/**
	 * @var mixed $_data extended exception data
	 */
	private $_data = null;

	/**
	 * Set exception extended data
	 *
	 * @param mixed $data extended exception data
	 *
	 * @return $this current object
	 */
	public function setData($data)
	{
		$this->_data = $data;

		return $this;
	}

	/**
	 * Get exception extended data
	 *
	 * @return mixed exception data
	 */
	public function getData()
	{
		return $this->_data;
	}
} 
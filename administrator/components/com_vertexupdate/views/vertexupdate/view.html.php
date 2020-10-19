<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die;

/**
 * HelloWorld View
 *
 * @since  0.0.1
 */
class VertexUpdateViewVertexUpdate extends JViewLegacy
{
	/**
	 * View form
	 *
	 * @var         form
	 */
	protected $form = null;

	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
         JToolbarHelper::title(JText::_('COM_VERTEXUPDATE_VIEW_DEFAULT_TITLE'), 'loop install');

		// Get the Data
		$form = $this->get('Form');
		$item = $this->get('Item');

		$errors = $this->get('Errors');
		// Check for errors.
		if ($errors)
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Assign the Data
		$this->form = $form;
		$this->item = $item;
		
		// Display the template
		parent::display($tpl);
	}
}

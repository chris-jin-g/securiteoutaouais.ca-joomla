<?php
/**
 * Project view
 *
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;
jimport('joomla.application.component.view');

class TimeWorkedViewUser extends JViewLegacy
{
	/**
	 * {@inheritdoc}
	 */
	public function display($tpl = null)
	{
		$this->userId   = JFactory::getApplication()->input->getUint('id');
		$this->projects = $this->getModel()->getProjects($this->userId);
		$this->username = JFactory::getUser($this->userId)->get('name');
		$this->email = JFactory::getUser($this->userId)->get('email');

		$this->_setToolbar();

		parent::display($tpl);
	}

	private function _setToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);
		JHTML::_('behavior.keepalive');

		JToolBarHelper::title(JText::_('COM_TIMEWORKED') . ': ' . JText::_('JTOOLBAR_EDIT') . ' ' . JText::_('COM_TIMEWORKED_USER'));

		JToolBarHelper::apply('user.apply');
		JToolBarHelper::save('user.save');
		JToolBarHelper::cancel('user.cancel');
	}
}

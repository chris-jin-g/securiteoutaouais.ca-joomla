<?php
/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;
defined('JPATH_PLATFORM') or die;

/**
 * Pagination Class. Provides a common interface for content pagination for the Joomla! CMS.
 */
class LeavesPagination extends JPagination
{
	/**
	 * Create and return the pagination data object.
	 *
	 * @return  object  Pagination data object.
	 */
	protected function _buildDataObject()
	{
		$data = parent::_buildDataObject();

		$data->start->link    = $this->_updateParams($data->start->link);
		$data->previous->link = $this->_updateParams($data->previous->link);
		$data->next->link     = $this->_updateParams($data->next->link);
		$data->end->link      = $this->_updateParams($data->end->link);
		$data->all->link      = $this->_updateParams($data->all->link);

		foreach ($data->pages as &$item)
		{
			$item->link = $this->_updateParams($item->link);
		}

		return $data;
	}

	/**
	 * Add or update filter params to query string
	 *
	 * @param string $url incoming url
	 *
	 * @return string updated url
	 */
	private function _updateParams($url)
	{
//		$filters = array('filter_client', 'filter_project', 'filter_staff', 'filter_date_month');
//		$input   = JFactory::getApplication()->input;
//
//		foreach ($filters as $filter)
//		{
//			$url = $this->_updateQueryStringParameter($url, $filter, $input->getString($filter, ''));
//		}

		$url = str_replace('&amp;ajax=true', '', $url);
		$url = preg_replace('/\?ajax=true(&amp;)?/', '?', $url);

		return $url;
	}

	/**
	 * Update parameter in url
	 *
	 * @param string $uri   url
	 * @param string $key   parameter key
	 * @param string $value parameter value
	 *
	 * @return string result url
	 */
	private function _updateQueryStringParameter($uri, $key, $value)
	{
		$re        = '/([?&amp;])' . $key . '=.*?(&|$amp;)/i';
		$separator = strrpos($uri, '?') !== -1 ? '&' : '?';

		return preg_match($re, $uri) ?
			preg_replace($re, '$1' . $key . '=' . $value . '$2', $uri) : $uri . $separator . $key . '=' . $value;
	}

	/**
	 * Return the pagination footer.
	 *
	 * @return  string  Pagination footer.
	 */
	public function getListFooter()
	{
		$list = array(
			'prefix'       => $this->prefix,
			'limit'        => $this->limit,
			'limitstart'   => $this->limitstart,
			'total'        => $this->total,
			'limitfield'   => $this->getLimitBox(),
			'pagescounter' => $this->getPagesCounter(),
			'pageslinks'   => $this->getPagesLinks(),
		);

		$html = '<div class="limit pull-right">' . JText::_('JGLOBAL_DISPLAY_NUM') . $list['limitfield'] . '</div>' . $this->getPages();

		return $html;
	}

	/**
	 * Return pagination list
	 *
	 * @return string Pagination list
	 */
	public function getPages()
	{
		return '<div class="pagination pagination-toolbar" style="text-align: center;">' . $this->getPagesLinks() .
		'<input type="hidden" name="' . $this->prefix . 'limitstart" value="' . $this->limitstart . '" /></div>';
	}

	/**
	 * Creates a dropdown box for selecting how many records to show per page.
	 *
	 * @return  string  The HTML for the limit # input box.
	 *
	 * @since   1.5
	 */
	public function getLimitBox()
	{
		$app    = JFactory::getApplication();
		$limits = array();

		// Make the option list.
		for ($i = 5; $i <= 30; $i += 5)
		{
			$limits[] = JHtml::_('select.option', "$i");
		}

		$limits[] = JHtml::_('select.option', '50', JText::_('J50'));
		$limits[] = JHtml::_('select.option', '100', JText::_('J100'));
		$limits[] = JHtml::_('select.option', '0', JText::_('JALL'));

		$selected = $this->viewall ? 0 : $this->limit;

		$html = JHtml::_(
			'select.genericlist',
			$limits,
			$this->prefix . 'limit',
			'class="inputbox input-mini chzn-done" size="1" onchange="this.form.submit()"',
			'value',
			'text',
			$selected
		);

		return $html;
	}
}

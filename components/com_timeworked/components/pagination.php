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
class Pagination extends JPagination
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
		$filters = array('filter_client', 'filter_project', 'filter_staff', 'filter_date_month', 'filter_keyword', 'filter_ticket');
		$input   = JFactory::getApplication()->input;

		foreach ($filters as $filter)
		{
			$url = $this->_updateQueryStringParameter($url, $filter, $input->getString($filter, ''));
		}

		$url = str_replace('&amp;task=getData', '', $url);
		$url = str_replace('&amp;start=', '&amp;limitstart=', $url);

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
    
    /**
	 * Create and return the pagination page list string, ie. Previous, Next, 1 2 3 ... x.
	 *
	 * @return  string  Pagination page list string.
	 *
	 * @since   1.5
	 */
	public function getPagesLinks()
	{
		$app = JFactory::getApplication();

		// Build the page navigation list.
		$data = $this->_buildDataObject();

		$list = array();
		$list['prefix'] = $this->prefix;

		$itemOverride = false;
		$listOverride = false;

		$chromePath = JPATH_THEMES . '/' . $app->getTemplate() . '/html/pagination.php';

		if (file_exists($chromePath))
		{
			include_once $chromePath;

			if (function_exists('pagination_item_active') && function_exists('pagination_item_inactive'))
			{
				$itemOverride = true;
			}

			if (function_exists('pagination_list_render'))
			{
				$listOverride = true;
			}
		}

		// Build the select list
		if ($data->all->base !== null)
		{
			$list['all']['active'] = true;
			$list['all']['data'] = $this->_item_active($data->all);
		}
		else
		{
			$list['all']['active'] = false;
			$list['all']['data'] = $this->_item_inactive($data->all);
		}

		if ($data->start->base !== null)
		{
			$list['start']['active'] = true;
			$list['start']['data'] = $this->_item_active($data->start);
		}
		else
		{
			$list['start']['active'] = false;
			$list['start']['data'] = $this->_item_inactive($data->start);
		}

		if ($data->previous->base !== null)
		{
			$list['previous']['active'] = true;
			$list['previous']['data'] = $this->_item_active($data->previous);
		}
		else
		{
			$list['previous']['active'] = false;
			$list['previous']['data'] = $this->_item_inactive($data->previous);
		}

		// Make sure it exists
		$list['pages'] = array();

		foreach ($data->pages as $i => $page)
		{
			if ($page->base !== null)
			{
				$list['pages'][$i]['active'] = true;
				$list['pages'][$i]['data'] = $this->_item_active($page);
			}
			else
			{
				$list['pages'][$i]['active'] = false;
				$list['pages'][$i]['data'] = $this->_item_inactive($page);
			}
		}

		if ($data->next->base !== null)
		{
			$list['next']['active'] = true;
			$list['next']['data'] = $this->_item_active($data->next);
		}
		else
		{
			$list['next']['active'] = false;
			$list['next']['data'] = $this->_item_inactive($data->next);
		}

		if ($data->end->base !== null)
		{
			$list['end']['active'] = true;
			$list['end']['data'] = $this->_item_active($data->end);
		}
		else
		{
			$list['end']['active'] = false;
			$list['end']['data'] = $this->_item_inactive($data->end);
		}

		if ($this->total > $this->limit)
		{
			return $this->_list_render($list);
		}
		else
		{
			return '';
		}
	}
	protected function _item_active(JPaginationObject $item)
	{
		$app = JFactory::getApplication();

		$title = '';
		$class = '';

		if (!is_numeric($item->text))
		{
			JHtml::_('bootstrap.tooltip');
			$title = ' title="' . $item->text . '"';
		}

		if ($app->isAdmin())
		{
			return '<a' . $title . ' href="#" onclick="document.adminForm.' . $this->prefix
			. 'limitstart.value=' . ($item->base > 0 ? $item->base : '0') . '; Joomla.submitform();return false;">' . $item->text . '</a>';
		}
		else
		{
			return '<a' . $title . ' href="' . $item->link . '" class="' . $class . 'pagenav">' . $item->text . '</a>';
		}
	}
    
}

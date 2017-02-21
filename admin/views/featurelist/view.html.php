<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @package     Joomla.Administrator
 * @subpackage  com_jea
 * @copyright   Copyright (C) 2008 - 2012 PHILIP Sylvain. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

require JPATH_COMPONENT . DS . 'helpers' . DS . 'jea.php';

/**
 * View to manage a feature list.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_jea
 *
 * @since       2.0
 */
class JeaViewFeaturelist extends JViewLegacy
{
	/**
	 * Overrides parent method.
	 *
	 * @param   string  $tpl  The name of the template file to parse.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @see     JViewLegacy::display()
	 */
	public function display($tpl = null)
	{
		$params = JComponentHelper::getParams('com_jea');
		$this->assignRef('params', $params);

		JeaHelper::addSubmenu('features');

		$this->user = JFactory::getUser();
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state = $this->get('State');

		if ((float) JVERSION > 3)
		{
			$this->sidebar = JHtmlSidebar::render();
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 */
	protected function addToolbar()
	{
		$canDo = JeaHelper::getActions();
		$feature = $this->state->get('feature.name');

		JToolBarHelper::title(JText::_(JString::strtoupper("com_jea_list_of_{$feature}_title")), 'jea.png');

		if ($canDo->get('core.create'))
		{
			JToolBarHelper::addNew('feature.add');
		}

		if ($canDo->get('core.edit'))
		{
			JToolBarHelper::editList('feature.edit');
		}

		if ($canDo->get('core.delete'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::deleteList(JText::_('COM_JEA_MESSAGE_CONFIRM_DELETE'), 'featurelist.delete');
		}
	}
}

<?php
defined( '_JEXEC' ) or die;

class ZtvirtuemarterViewComparelist extends JViewLegacy
{
	function display($tpl = null) 
	{
		$app = JFactory::getApplication();
		$pathway = $app->getPathway();
		$pathway->addItem(JText::_('COM_COMPARE_COMPARE_PRODUCT'),JRoute::_('index.php?option=com_ztvirtuemarter&view=comparelist'));

		parent::display($tpl);
	}
}

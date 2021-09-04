<?php
namespace Vnext\Training\Block\Adminhtml;


class Student extends \Magento\Backend\Block\Widget\Grid\Container
{

	protected function _construct()
	{
		$this->_controller = 'adminhtml_student';
		$this->_blockGroup = 'Vnext_Training';
		$this->_headerText = __('Students');
		$this->_addButtonLabel = __('Create New Post');
		parent::_construct();
	}
}

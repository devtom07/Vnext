<?php
namespace Vnext\Training\Model\ResourceModel\Student;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{
    protected $_idFieldName = 'entity_id';
	protected $_eventPrefix = 'students_collection';
	protected $_eventObject = 'Student_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
    public function _construct()
    {
        $this->_init("Vnext\Training\Model\Student","Vnext\Training\Model\ResourceModel\Student");
    }
}
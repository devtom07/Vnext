<?php
namespace Vnext\Training\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;



class Student extends AbstractDb{
    protected $_idFieldName = "emtity_id";
    public function _construct()
    {
        $this->_init("students","entity_id");
    }
}   
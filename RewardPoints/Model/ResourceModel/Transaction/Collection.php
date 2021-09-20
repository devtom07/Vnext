<?php
namespace Vnext\RewardPoints\Model\ResourceModel\Transaction;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Vnext\RewardPoints\Model\Transaction', 'Vnext\RewardPoints\Model\ResourceModel\Transaction');
    }
}

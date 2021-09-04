<?php

namespace Vnext\Training\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface StudentSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Vnext\Training\Api\Data\StudentInterface[]
     */
    public function getItems();

    /**
     * @param \Vnext\Training\Api\Data\StudentInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
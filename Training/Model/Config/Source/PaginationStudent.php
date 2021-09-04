<?php
namespace Vnext\Training\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class PaginationStudent implements ArrayInterface
{

    public function toOptionArray()
    {
    return [
        '5' => '5',
         '10' => '10'
    ];

    }
}
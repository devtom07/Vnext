<?php

namespace Vnext\Training\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class student implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            'asc' => 'Asc',
            'desc' => 'Desc'
        ];
    }
}
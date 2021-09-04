<?php
namespace Vnext\ProductShippingMethod\Model\Config\Product;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class ExtensionOption extends AbstractSource
{
    protected $scopeConfig;
    protected $shipconfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Shipping\Model\Config $shipconfig
    ) {
        $this->shipconfig = $shipconfig;
        $this->scopeConfig = $scopeConfig;
    }

    public function getAllOptions() {
        $activeCarriers = $this->shipconfig->getActiveCarriers();
        $methods = [];
        foreach($activeCarriers as $carrierCode => $carrierModel) {
                $carrierTitle = $this->scopeConfig
                    ->getValue('carriers/'.$carrierCode.'/title');
            $methods[] = array('value' => $carrierTitle, 'label' => $carrierTitle);
        }

        return $methods;
    }

}

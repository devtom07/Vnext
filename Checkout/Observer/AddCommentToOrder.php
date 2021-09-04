<?php
namespace Vnext\Checkout\Observer;

class AddCommentToOrder implements \Magento\Framework\Event\ObserverInterface
{
    protected $request;

    public function __construct(\Magento\Framework\App\RequestInterface $request)
    {
        $this->request = $request;
    }
    /**
     * Assign quote to session
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $requestContent = json_decode($this->request->getContent(), true);
        $order = $observer->getEvent()->getOrder();

        $order->setCustomerNoteNotify(0);
        if($customerNote = $requestContent['paymentMethod']['extension_attributes']['customer_note'] ?? null){
            $order->setData(
                'customer_note',
                $customerNote
            );
        }
    }
}
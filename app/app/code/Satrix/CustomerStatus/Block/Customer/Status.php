<?php
namespace Satrix\CustomerStatus\Block\Customer;
 
use Magento\Backend\Block\Template\Context;
use Magento\Customer\Model\SessionFactory;
 
class Status extends \Magento\Framework\View\Element\Template
{        
 
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

 
    /**
     * @var \Magento\Customer\Model\Customer 
     */
    protected $customerModel;
 
    public function __construct(
        Context $context,
        SessionFactory $customerSession,
        \Magento\Customer\Model\Customer $customerModel,
        array $data = []
    )
    {        
        $this->customerSession       = $customerSession->create();
        $this->customerModel         = $customerModel;
 
        parent::__construct($context, $data);
 
        $collection = $this->getContracts();
        $this->setCollection($collection);
    }

 
    public function getCustomerStatus()
    {
				
        $customerData = $this->customerModel->load($this->customerSession->getId());
        $status = $customerData->getData('customer_status');
		//echo "<pre>"; print_r($customerData->getData('customer_status')); exit;
        if (!empty($status)) {
            return $status;
        }
        return false;
    }

}

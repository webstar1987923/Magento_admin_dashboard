<?php
namespace Satrix\CustomerStatus\Controller\Index;

use Magento\Customer\Model\SessionFactory;
use Magento\Framework\Controller\ResultFactory; 

class Post extends \Magento\Framework\App\Action\Action
{

	protected $customer;

	protected $customerFactory;

	protected $customerSession;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\Framework\App\Response\Http $resultRedirect,
		SessionFactory $customerSession,
		\Magento\Customer\Model\Customer $customer,
		\Magento\Customer\Model\ResourceModel\CustomerFactory $customerFactory,
		\Magento\Framework\Message\ManagerInterface $messageManager
	)
	{
		$this->customerSession       = $customerSession->create();
		$this->customer = $customer;
		$this->customerFactory = $customerFactory;
		$this->resultRedirect = $resultRedirect;
		$this->_pageFactory = $pageFactory;
		$this->_messageManager = $messageManager;
		return parent::__construct($context);
		
	}

	public function execute()
	{
		try{

			$customerStatus = $this->getRequest()->getParam('customer_status');
			

			$customer = $this->customer->load($this->customerSession->getId());
			
			$customer->setData('customer_status', $customerStatus);
			$customer->save();
			$this->messageManager->addSuccess(
                    __('Status has been save successfully'));
			
		}
		catch(Exception $e){
			$this->messageManager->addSuccess($e->getMessage()); 
		}
		$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        

        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
	}
}
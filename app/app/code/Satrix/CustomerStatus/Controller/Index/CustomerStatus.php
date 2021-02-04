<?php
namespace Satrix\CustomerStatus\Controller\Index;

class CustomerStatus extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $resultRedirect;
	
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\Framework\App\Response\Http $resultRedirect
    )
	{
		$this->resultRedirect = $resultRedirect;
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		$this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
	}
}


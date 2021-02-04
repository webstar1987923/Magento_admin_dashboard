<?php

namespace Satrix\CustomerStatus\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;

class InstallData implements InstallDataInterface
{
	private $eavSetupFactory;

	public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig, CustomerSetupFactory $customerSetupFactory)
	{
		$this->eavSetupFactory = $eavSetupFactory;
		$this->eavConfig       = $eavConfig;
		$this->customerSetupFactory = $customerSetupFactory;
	}

	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();
		if (version_compare($context->getVersion(), '1.0.1', '<')) {
			$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
			$customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
	 
			$customerSetup->addAttribute(
				\Magento\Customer\Model\Customer::ENTITY, 
				'customer_status', 
				[
					'type' => 'int',
					'label' => 'Customer Status',
					'input' => 'select',
					'source' => 'Satrix\CustomerStatus\Model\Config\Source\Option',
					'required' => false,
					'visible' => true,
					'position' => 200,
					'system' => false,
					'user_defined' => true,
					'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
					'is_used_in_grid' => true,
					'is_visible_in_grid' => true,
					'is_filterable_in_grid' => true,
					'is_searchable_in_grid' => false
				]				
			);

			
			$_attribute = $customerSetup->getEavConfig()->getAttribute(\Magento\Customer\Model\Customer::ENTITY,'customer_status')
							->addData(
								['used_in_forms' => [
									'adminhtml_customer',
									'customer_account_create',
									'customer_account_edit'
								]
							]);
			$_attribute->save();
		}
        $setup->endSetup();
	}
}
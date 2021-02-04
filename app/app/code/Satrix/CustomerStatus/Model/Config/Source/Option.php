<?php
 
namespace Satrix\CustomerStatus\Model\Config\Source;
 
class Option extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
    * Get all options
    *
    * @return array
    */
    public function getAllOptions()
    {
        $this->_options = [
                ['label' => __('Please Select Status'), 'value'=>''],
                ['label' => __('Enable'), 'value'=>1],
                ['label' => __('Disable'), 'value'=>2]
            ];
 
    return $this->_options;
 
    }
 
}

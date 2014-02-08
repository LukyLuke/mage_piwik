<?php
/**
 * Delight_Piwik Customisation by delight software gmbh for Magento
 *
 * DISCLAIMER
 *
 * Do not edit or add code to this file if you wish to upgrade this Module to newer
 * versions in the future.
 *
 * @category   Custom
 * @package    Delight_Piwik
 * @copyright  Copyright (c) 2001-2011 delight software gmbh (http://www.delightsoftware.com/)
 */

/**
 * Simple Select for enabling/Disabling the Piwik-IOntegration
 *
 * @category   Custom
 * @package    Delight_Piwik
 * @author     delight software gmbh <info@delightsoftware.com>
 */
class Delight_Piwik_Model_Source_Select
{
    public function toOptionArray()
    {
        return array(
        	array('value' => 0, 'label' => Mage::helper('delightpdf')->__('No')),
            array('value' => 1, 'label' => Mage::helper('delightpdf')->__('Yes'))
        );
    }
}

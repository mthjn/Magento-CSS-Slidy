<?php
/**
 * TestNamespace_TestModule extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       TestNamespace
 * @package        TestNamespace_TestModule
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * ImageURL widget block
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_Block_Imageurl_Widget_View extends Mage_Core_Block_Template implements
    Mage_Widget_Block_Interface
{
    protected $_htmlTemplate = 'testnamespace_testmodule/imageurl/widget/view.phtml';

    /**
     * Prepare a for widget
     *
     * @access protected
     * @return TestNamespace_TestModule_Block_Imageurl_Widget_View
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        parent::_beforeToHtml();
        $imageurlId = $this->getData('imageurl_id');
        if ($imageurlId) {
            $imageurl = Mage::getModel('testnamespace_testmodule/imageurl')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($imageurlId);
            if ($imageurl->getStatus()) {
                $this->setCurrentImageurl($imageurl);
                $this->setTemplate($this->_htmlTemplate);
            }
        }
        return $this;
    }
}

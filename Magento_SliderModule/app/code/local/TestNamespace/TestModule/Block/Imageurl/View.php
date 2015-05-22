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
 * ImageURL view block
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_Block_Imageurl_View extends Mage_Core_Block_Template
{
    /**
     * get the current imageurl
     *
     * @access public
     * @return mixed (TestNamespace_TestModule_Model_Imageurl|null)
     * @author Ultimate Module Creator
     */
    public function getCurrentImageurl()
    {
        return Mage::registry('current_imageurl');
    }
}

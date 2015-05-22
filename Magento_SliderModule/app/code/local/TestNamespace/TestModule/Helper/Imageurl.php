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
 * ImageURL helper
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_Helper_Imageurl extends Mage_Core_Helper_Abstract
{

    /**
     * get the url to the imagesurl list page
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getImagesurlUrl()
    {
        if ($listKey = Mage::getStoreConfig('testnamespace_testmodule/imageurl/url_rewrite_list')) {
            return Mage::getUrl('', array('_direct'=>$listKey));
        }
        return Mage::getUrl('testnamespace_testmodule/imageurl/index');
    }

    /**
     * check if breadcrumbs can be used
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function getUseBreadcrumbs()
    {
        return Mage::getStoreConfigFlag('testnamespace_testmodule/imageurl/breadcrumbs');
    }

    /**
     * check if the rss for imageurl is enabled
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function isRssEnabled()
    {
        return  Mage::getStoreConfigFlag('rss/config/active') &&
            Mage::getStoreConfigFlag('testnamespace_testmodule/imageurl/rss');
    }

    /**
     * get the link to the imageurl rss list
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRssUrl()
    {
        return Mage::getUrl('testnamespace_testmodule/imageurl/rss');
    }
}

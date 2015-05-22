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
 * ImageURL model
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_Model_Imageurl extends Mage_Core_Model_Abstract
{
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'testnamespace_testmodule_imageurl';
    const CACHE_TAG = 'testnamespace_testmodule_imageurl';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'testnamespace_testmodule_imageurl';

    /**
     * Parameter name in event
     *
     * @var string
     */
    protected $_eventObject = 'imageurl';

    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('testnamespace_testmodule/imageurl');
    }

    /**
     * before save imageurl
     *
     * @access protected
     * @return TestNamespace_TestModule_Model_Imageurl
     * @author Ultimate Module Creator
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()) {
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);
        return $this;
    }

    /**
     * get the url to the imageurl details page
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getImageurlUrl()
    {
        if ($this->getUrlKey()) {
            $urlKey = '';
            if ($prefix = Mage::getStoreConfig('testnamespace_testmodule/imageurl/url_prefix')) {
                $urlKey .= $prefix.'/';
            }
            $urlKey .= $this->getUrlKey();
            if ($suffix = Mage::getStoreConfig('testnamespace_testmodule/imageurl/url_suffix')) {
                $urlKey .= '.'.$suffix;
            }
            return Mage::getUrl('', array('_direct'=>$urlKey));
        }
        return Mage::getUrl('testnamespace_testmodule/imageurl/view', array('id'=>$this->getId()));
    }

    /**
     * check URL key
     *
     * @access public
     * @param string $urlKey
     * @param bool $active
     * @return mixed
     * @author Ultimate Module Creator
     */
    public function checkUrlKey($urlKey, $active = true)
    {
        return $this->_getResource()->checkUrlKey($urlKey, $active);
    }

    /**
     * save imageurl relation
     *
     * @access public
     * @return TestNamespace_TestModule_Model_Imageurl
     * @author Ultimate Module Creator
     */
    protected function _afterSave()
    {
        return parent::_afterSave();
    }

    /**
     * check if comments are allowed
     *
     * @access public
     * @return array
     * @author Ultimate Module Creator
     */
    public function getAllowComments()
    {
        if ($this->getData('allow_comment') == TestNamespace_TestModule_Model_Adminhtml_Source_Yesnodefault::NO) {
            return false;
        }
        if ($this->getData('allow_comment') == TestNamespace_TestModule_Model_Adminhtml_Source_Yesnodefault::YES) {
            return true;
        }
        return Mage::getStoreConfigFlag('testnamespace_testmodule/imageurl/allow_comment');
    }

    /**
     * get default values
     *
     * @access public
     * @return array
     * @author Ultimate Module Creator
     */
    public function getDefaultValues()
    {
        $values = array();
        $values['status'] = 1;
        $values['in_rss'] = 1;
        $values['allow_comment'] = TestNamespace_TestModule_Model_Adminhtml_Source_Yesnodefault::USE_DEFAULT;
        $values['abclink'] = 'http://placehold.it/890x380';

        return $values;
    }
    
}

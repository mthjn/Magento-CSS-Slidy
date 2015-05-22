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
 * ImageURL list block
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author Ultimate Module Creator
 */
class TestNamespace_TestModule_Block_Imageurl_List extends Mage_Core_Block_Template
{
    /**
     * initialize
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $imagesurl = Mage::getResourceModel('testnamespace_testmodule/imageurl_collection')
                         ->addStoreFilter(Mage::app()->getStore())
                         ->addFieldToFilter('status', 1);
        $imagesurl->setOrder('abclink', 'asc');
        $this->setImagesurl($imagesurl);
    }

    /**
     * prepare the layout
     *
     * @access protected
     * @return TestNamespace_TestModule_Block_Imageurl_List
     * @author Ultimate Module Creator
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock(
            'page/html_pager',
            'testnamespace_testmodule.imageurl.html.pager'
        )
        ->setCollection($this->getImagesurl());
        $this->setChild('pager', $pager);
        $this->getImagesurl()->load();
        return $this;
    }

    /**
     * get the pager html
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}

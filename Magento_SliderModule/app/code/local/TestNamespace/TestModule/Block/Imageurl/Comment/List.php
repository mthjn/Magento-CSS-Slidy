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
 * ImageURL comment list block
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author Ultimate Module Creator
 */
class TestNamespace_TestModule_Block_Imageurl_Comment_List extends Mage_Core_Block_Template
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
        $imageurl = $this->getImageurl();
        $comments = Mage::getResourceModel('testnamespace_testmodule/imageurl_comment_collection')
            ->addFieldToFilter('imageurl_id', $imageurl->getId())
            ->addStoreFilter(Mage::app()->getStore())
             ->addFieldToFilter('status', 1);
        $comments->setOrder('created_at', 'asc');
        $this->setComments($comments);
    }

    /**
     * prepare the layout
     *
     * @access protected
     * @return TestNamespace_TestModule_Block_Imageurl_Comment_List
     * @author Ultimate Module Creator
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock(
            'page/html_pager',
            'testnamespace_testmodule.imageurl.html.pager'
        )
        ->setCollection($this->getComments());
        $this->setChild('pager', $pager);
        $this->getComments()->load();
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
    /**
     * get the current imageurl
     *
     * @access protected
     * @return TestNamespace_TestModule_Model_Imageurl
     * @author Ultimate Module Creator
     */
    public function getImageurl()
    {
        return Mage::registry('current_imageurl');
    }
}

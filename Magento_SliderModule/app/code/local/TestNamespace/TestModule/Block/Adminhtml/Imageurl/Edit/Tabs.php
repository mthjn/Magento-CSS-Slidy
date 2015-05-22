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
 * ImageURL admin edit tabs
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_Block_Adminhtml_Imageurl_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize Tabs
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('imageurl_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('testnamespace_testmodule')->__('ImageURL'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return TestNamespace_TestModule_Block_Adminhtml_Imageurl_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_imageurl',
            array(
                'label'   => Mage::helper('testnamespace_testmodule')->__('ImageURL'),
                'title'   => Mage::helper('testnamespace_testmodule')->__('ImageURL'),
                'content' => $this->getLayout()->createBlock(
                    'testnamespace_testmodule/adminhtml_imageurl_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        $this->addTab(
            'form_meta_imageurl',
            array(
                'label'   => Mage::helper('testnamespace_testmodule')->__('Meta'),
                'title'   => Mage::helper('testnamespace_testmodule')->__('Meta'),
                'content' => $this->getLayout()->createBlock(
                    'testnamespace_testmodule/adminhtml_imageurl_edit_tab_meta'
                )
                ->toHtml(),
            )
        );
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addTab(
                'form_store_imageurl',
                array(
                    'label'   => Mage::helper('testnamespace_testmodule')->__('Store views'),
                    'title'   => Mage::helper('testnamespace_testmodule')->__('Store views'),
                    'content' => $this->getLayout()->createBlock(
                        'testnamespace_testmodule/adminhtml_imageurl_edit_tab_stores'
                    )
                    ->toHtml(),
                )
            );
        }
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve imageurl entity
     *
     * @access public
     * @return TestNamespace_TestModule_Model_Imageurl
     * @author Ultimate Module Creator
     */
    public function getImageurl()
    {
        return Mage::registry('current_imageurl');
    }
}

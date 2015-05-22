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
 * ImageURL admin edit form
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_Block_Adminhtml_Imageurl_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'testnamespace_testmodule';
        $this->_controller = 'adminhtml_imageurl';
        $this->_updateButton(
            'save',
            'label',
            Mage::helper('testnamespace_testmodule')->__('Save ImageURL')
        );
        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('testnamespace_testmodule')->__('Delete ImageURL')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('testnamespace_testmodule')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );
        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * get the edit form header
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_imageurl') && Mage::registry('current_imageurl')->getId()) {
            return Mage::helper('testnamespace_testmodule')->__(
                "Edit ImageURL '%s'",
                $this->escapeHtml(Mage::registry('current_imageurl')->getAbclink())
            );
        } else {
            return Mage::helper('testnamespace_testmodule')->__('Add ImageURL');
        }
    }
}

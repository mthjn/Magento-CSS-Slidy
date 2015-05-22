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
 * store selection tab
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_Block_Adminhtml_Imageurl_Comment_Edit_Tab_Stores extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return TestNamespace_TestModule_Block_Adminhtml_Imageurl_Comment_Edit_Tab_Stores
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setFieldNameSuffix('comment');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'imageurl_comment_stores_form',
            array('legend' => Mage::helper('testnamespace_testmodule')->__('Store views'))
        );
        $field = $fieldset->addField(
            'store_id',
            'multiselect',
            array(
                'name'  => 'stores[]',
                'label' => Mage::helper('testnamespace_testmodule')->__('Store Views'),
                'title' => Mage::helper('testnamespace_testmodule')->__('Store Views'),
                'required'  => true,
                'values'=> Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            )
        );
        $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
        $field->setRenderer($renderer);
        $form->addValues(Mage::registry('current_comment')->getData());
        return parent::_prepareForm();
    }
}

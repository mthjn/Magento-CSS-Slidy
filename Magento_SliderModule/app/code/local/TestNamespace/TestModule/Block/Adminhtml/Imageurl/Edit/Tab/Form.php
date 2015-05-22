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
 * ImageURL edit form tab
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_Block_Adminhtml_Imageurl_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return TestNamespace_TestModule_Block_Adminhtml_Imageurl_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('imageurl_');
        $form->setFieldNameSuffix('imageurl');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'imageurl_form',
            array('legend' => Mage::helper('testnamespace_testmodule')->__('ImageURL'))
        );

        $fieldset->addField(
            'abclink',
            'text',
            array(
                'label' => Mage::helper('testnamespace_testmodule')->__('ABC Link'),
                'name'  => 'abclink',
            'required'  => true,
            'class' => 'required-entry',

           )
        );
        $fieldset->addField(
            'url_key',
            'text',
            array(
                'label' => Mage::helper('testnamespace_testmodule')->__('Url key'),
                'name'  => 'url_key',
                'note'  => Mage::helper('testnamespace_testmodule')->__('Relative to Website Base URL')
            )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('testnamespace_testmodule')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('testnamespace_testmodule')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('testnamespace_testmodule')->__('Disabled'),
                    ),
                ),
            )
        );
        $fieldset->addField(
            'in_rss',
            'select',
            array(
                'label'  => Mage::helper('testnamespace_testmodule')->__('Show in rss'),
                'name'   => 'in_rss',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('testnamespace_testmodule')->__('Yes'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('testnamespace_testmodule')->__('No'),
                    ),
                ),
            )
        );
        if (Mage::app()->isSingleStoreMode()) {
            $fieldset->addField(
                'store_id',
                'hidden',
                array(
                    'name'      => 'stores[]',
                    'value'     => Mage::app()->getStore(true)->getId()
                )
            );
            Mage::registry('current_imageurl')->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $fieldset->addField(
            'allow_comment',
            'select',
            array(
                'label' => Mage::helper('testnamespace_testmodule')->__('Allow Comments'),
                'name'  => 'allow_comment',
                'values'=> Mage::getModel('testnamespace_testmodule/adminhtml_source_yesnodefault')->toOptionArray()
            )
        );
        $formValues = Mage::registry('current_imageurl')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getImageurlData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getImageurlData());
            Mage::getSingleton('adminhtml/session')->setImageurlData(null);
        } elseif (Mage::registry('current_imageurl')) {
            $formValues = array_merge($formValues, Mage::registry('current_imageurl')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}

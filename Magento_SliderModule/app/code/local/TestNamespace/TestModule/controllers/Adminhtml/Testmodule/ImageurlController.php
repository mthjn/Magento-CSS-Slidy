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
 * ImageURL admin controller
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_Adminhtml_Testmodule_ImageurlController extends TestNamespace_TestModule_Controller_Adminhtml_TestModule
{
    /**
     * init the imageurl
     *
     * @access protected
     * @return TestNamespace_TestModule_Model_Imageurl
     */
    protected function _initImageurl()
    {
        $imageurlId  = (int) $this->getRequest()->getParam('id');
        $imageurl    = Mage::getModel('testnamespace_testmodule/imageurl');
        if ($imageurlId) {
            $imageurl->load($imageurlId);
        }
        Mage::register('current_imageurl', $imageurl);
        return $imageurl;
    }

    /**
     * default action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title(Mage::helper('testnamespace_testmodule')->__('Module Test'))
             ->_title(Mage::helper('testnamespace_testmodule')->__('ImagesURL'));
        $this->renderLayout();
    }

    /**
     * grid action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction()
    {
        $this->loadLayout()->renderLayout();
    }

    /**
     * edit imageurl - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $imageurlId    = $this->getRequest()->getParam('id');
        $imageurl      = $this->_initImageurl();
        if ($imageurlId && !$imageurl->getId()) {
            $this->_getSession()->addError(
                Mage::helper('testnamespace_testmodule')->__('This imageurl no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getImageurlData(true);
        if (!empty($data)) {
            $imageurl->setData($data);
        }
        Mage::register('imageurl_data', $imageurl);
        $this->loadLayout();
        $this->_title(Mage::helper('testnamespace_testmodule')->__('Module Test'))
             ->_title(Mage::helper('testnamespace_testmodule')->__('ImagesURL'));
        if ($imageurl->getId()) {
            $this->_title($imageurl->getAbclink());
        } else {
            $this->_title(Mage::helper('testnamespace_testmodule')->__('Add imageurl'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new imageurl action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save imageurl - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('imageurl')) {
            try {
                $imageurl = $this->_initImageurl();
                $imageurl->addData($data);
                $imageurl->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('testnamespace_testmodule')->__('ImageURL was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $imageurl->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setImageurlData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('testnamespace_testmodule')->__('There was a problem saving the imageurl.')
                );
                Mage::getSingleton('adminhtml/session')->setImageurlData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('testnamespace_testmodule')->__('Unable to find imageurl to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete imageurl - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $imageurl = Mage::getModel('testnamespace_testmodule/imageurl');
                $imageurl->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('testnamespace_testmodule')->__('ImageURL was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('testnamespace_testmodule')->__('There was an error deleting imageurl.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('testnamespace_testmodule')->__('Could not find imageurl to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete imageurl - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $imageurlIds = $this->getRequest()->getParam('imageurl');
        if (!is_array($imageurlIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('testnamespace_testmodule')->__('Please select imagesurl to delete.')
            );
        } else {
            try {
                foreach ($imageurlIds as $imageurlId) {
                    $imageurl = Mage::getModel('testnamespace_testmodule/imageurl');
                    $imageurl->setId($imageurlId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('testnamespace_testmodule')->__('Total of %d imagesurl were successfully deleted.', count($imageurlIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('testnamespace_testmodule')->__('There was an error deleting imagesurl.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass status change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction()
    {
        $imageurlIds = $this->getRequest()->getParam('imageurl');
        if (!is_array($imageurlIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('testnamespace_testmodule')->__('Please select imagesurl.')
            );
        } else {
            try {
                foreach ($imageurlIds as $imageurlId) {
                $imageurl = Mage::getSingleton('testnamespace_testmodule/imageurl')->load($imageurlId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d imagesurl were successfully updated.', count($imageurlIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('testnamespace_testmodule')->__('There was an error updating imagesurl.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export as csv - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction()
    {
        $fileName   = 'imageurl.csv';
        $content    = $this->getLayout()->createBlock('testnamespace_testmodule/adminhtml_imageurl_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as MsExcel - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction()
    {
        $fileName   = 'imageurl.xls';
        $content    = $this->getLayout()->createBlock('testnamespace_testmodule/adminhtml_imageurl_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as xml - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction()
    {
        $fileName   = 'imageurl.xml';
        $content    = $this->getLayout()->createBlock('testnamespace_testmodule/adminhtml_imageurl_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/testnamespace_testmodule/imageurl');
    }
}

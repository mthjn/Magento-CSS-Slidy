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
 * ImageURL front contrller
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_ImageurlController extends Mage_Core_Controller_Front_Action
{

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
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if (Mage::helper('testnamespace_testmodule/imageurl')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label' => Mage::helper('testnamespace_testmodule')->__('Home'),
                        'link'  => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'imagesurl',
                    array(
                        'label' => Mage::helper('testnamespace_testmodule')->__('ImagesURL'),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', Mage::helper('testnamespace_testmodule/imageurl')->getImagesurlUrl());
        }
        if ($headBlock) {
            $headBlock->setTitle(Mage::getStoreConfig('testnamespace_testmodule/imageurl/meta_title'));
            $headBlock->setKeywords(Mage::getStoreConfig('testnamespace_testmodule/imageurl/meta_keywords'));
            $headBlock->setDescription(Mage::getStoreConfig('testnamespace_testmodule/imageurl/meta_description'));
        }
        $this->renderLayout();
    }

    /**
     * init ImageURL
     *
     * @access protected
     * @return TestNamespace_TestModule_Model_Imageurl
     * @author Ultimate Module Creator
     */
    protected function _initImageurl()
    {
        $imageurlId   = $this->getRequest()->getParam('id', 0);
        $imageurl     = Mage::getModel('testnamespace_testmodule/imageurl')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($imageurlId);
        if (!$imageurl->getId()) {
            return false;
        } elseif (!$imageurl->getStatus()) {
            return false;
        }
        return $imageurl;
    }

    /**
     * view imageurl action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function viewAction()
    {
        $imageurl = $this->_initImageurl();
        if (!$imageurl) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_imageurl', $imageurl);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('testmodule-imageurl testmodule-imageurl' . $imageurl->getId());
        }
        if (Mage::helper('testnamespace_testmodule/imageurl')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label'    => Mage::helper('testnamespace_testmodule')->__('Home'),
                        'link'     => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'imagesurl',
                    array(
                        'label' => Mage::helper('testnamespace_testmodule')->__('ImagesURL'),
                        'link'  => Mage::helper('testnamespace_testmodule/imageurl')->getImagesurlUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'imageurl',
                    array(
                        'label' => $imageurl->getAbclink(),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', $imageurl->getImageurlUrl());
        }
        if ($headBlock) {
            if ($imageurl->getMetaTitle()) {
                $headBlock->setTitle($imageurl->getMetaTitle());
            } else {
                $headBlock->setTitle($imageurl->getAbclink());
            }
            $headBlock->setKeywords($imageurl->getMetaKeywords());
            $headBlock->setDescription($imageurl->getMetaDescription());
        }
        $this->renderLayout();
    }

    /**
     * imagesurl rss list action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function rssAction()
    {
        if (Mage::helper('testnamespace_testmodule/imageurl')->isRssEnabled()) {
            $this->getResponse()->setHeader('Content-type', 'text/xml; charset=UTF-8');
            $this->loadLayout(false);
            $this->renderLayout();
        } else {
            $this->getResponse()->setHeader('HTTP/1.1', '404 Not Found');
            $this->getResponse()->setHeader('Status', '404 File not found');
            $this->_forward('nofeed', 'index', 'rss');
        }
    }

    /**
     * Submit new comment action
     * @access public
     * @author Ultimate Module Creator
     */
    public function commentpostAction()
    {
        $data   = $this->getRequest()->getPost();
        $imageurl = $this->_initImageurl();
        $session    = Mage::getSingleton('core/session');
        if ($imageurl) {
            if ($imageurl->getAllowComments()) {
                if ((Mage::getSingleton('customer/session')->isLoggedIn() ||
                    Mage::getStoreConfigFlag('testnamespace_testmodule/imageurl/allow_guest_comment'))) {
                    $comment  = Mage::getModel('testnamespace_testmodule/imageurl_comment')->setData($data);
                    $validate = $comment->validate();
                    if ($validate === true) {
                        try {
                            $comment->setImageurlId($imageurl->getId())
                                ->setStatus(TestNamespace_TestModule_Model_Imageurl_Comment::STATUS_PENDING)
                                ->setCustomerId(Mage::getSingleton('customer/session')->getCustomerId())
                                ->setStores(array(Mage::app()->getStore()->getId()))
                                ->save();
                            $session->addSuccess($this->__('Your comment has been accepted for moderation.'));
                        } catch (Exception $e) {
                            $session->setImageurlCommentData($data);
                            $session->addError($this->__('Unable to post the comment.'));
                        }
                    } else {
                        $session->setImageurlCommentData($data);
                        if (is_array($validate)) {
                            foreach ($validate as $errorMessage) {
                                $session->addError($errorMessage);
                            }
                        } else {
                            $session->addError($this->__('Unable to post the comment.'));
                        }
                    }
                } else {
                    $session->addError($this->__('Guest comments are not allowed'));
                }
            } else {
                $session->addError($this->__('This imageurl does not allow comments'));
            }
        }
        $this->_redirectReferer();
    }
}

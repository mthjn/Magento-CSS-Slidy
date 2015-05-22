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
 * Admin search model
 *
 * @category    TestNamespace
 * @package     TestNamespace_TestModule
 * @author      Ultimate Module Creator
 */
class TestNamespace_TestModule_Model_Adminhtml_Search_Imageurl extends Varien_Object
{
    /**
     * Load search results
     *
     * @access public
     * @return TestNamespace_TestModule_Model_Adminhtml_Search_Imageurl
     * @author Ultimate Module Creator
     */
    public function load()
    {
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('testnamespace_testmodule/imageurl_collection')
            ->addFieldToFilter('abclink', array('like' => $this->getQuery().'%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $imageurl) {
            $arr[] = array(
                'id'          => 'imageurl/1/'.$imageurl->getId(),
                'type'        => Mage::helper('testnamespace_testmodule')->__('ImageURL'),
                'name'        => $imageurl->getAbclink(),
                'description' => $imageurl->getAbclink(),
                'url' => Mage::helper('adminhtml')->getUrl(
                    '*/testmodule_imageurl/edit',
                    array('id'=>$imageurl->getId())
                ),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}

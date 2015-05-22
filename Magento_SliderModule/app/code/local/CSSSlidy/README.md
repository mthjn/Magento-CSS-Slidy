###Function  
  
Get all base media url /cssslidy/slider  
Get all filenames for image extensions  
Get public urls of all these and flush them into css div  
  
Render the div with the links  
append javascript to create the CSS3  
Define a custom block for these  
Flush the custom block in CMS .. **and**?  
  
###To be done  
**remove the code from renderer and use the proper structure:**  
+ *create template and layout* 
+ *create block for the css3 flush?*  
+ apply the main function into **model**  
    extends Mage_Core_Model_Abstract  
+ create block to call this model  
   ```
   \app\code\local\Namespace\Module\Block\Getimages.php:  
   
    class ... extends Mage_Core_Block_Template  
    
      { protected function _toHtml() 
        { $myvar = Mage::getModel('Namespace_Module/Modelname');  
        
        ...  
        
        foreach $myvar do some HTML 
        
        ...
   ```
  
  + Add the **model** into config.xml below blocks, the same structure.  
    
###Links   
[CSSSlidy](http://dudleystorey.github.io/CSSslidy/)  
[Docs Magento](http://docs.magentocommerce.com/)  

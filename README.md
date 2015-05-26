
###Install  
+ Copy the files into your Magento file system  
+ Load any amount of images **of the same size** into  
    media/cssslidy/slider  
+ Add text for sliders if needed: System - Configuration - CSSSlidy
+ Change CSS for slider and captions in skin css, if needed  
+ Display slider as a block in CMS pages  
    {{block type="CSSSlidy_Slider/render"}}
  
###Function  
  
**All images in media/cssslidy/slider will be automatically added into slider**  
  
eg  
Get all base media url /cssslidy/slider  
Get all filenames for some image extensions  
Get public urls of all these and flush them into css div  
Render the div with the links  
append javascript to create the CSS3  
Flush this as a custom block in CMS .. **and**?  

  
###To be done  
+ integration? only {{block}}?  
+ Pictures via admin backend  

###Log  
+ Image captions
+ Admin Backend  
+ *created template / block*  
+ *crerated layout to flush js into footer block*  
+ pic search in **model**  
    extends Mage_Core_Model_Abstract  
+ model called from **block** (PHP)

###Based on / Links  

[CSSSlidy](http://dudleystorey.github.io/CSSslidy/)  

[Docs Magento](http://docs.magentocommerce.com/)  

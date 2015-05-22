<?php
// usage
// {{block type=""}}
class CSSSlidy_Slider_Block_Render extends Mage_Core_Block_Template {
  public function _toHtml() { ?>
    <?php //templating php in block? ?>
    <div id="slidy-container" style="width: 100%; overflow: hidden;margin-top: -7px;">
   <figure id="slidy">
    <img src="http://i1065.photobucket.com/albums/u381/jana2511/NL5/ipad-605439_1920_zpsb04bojgw.jpg" alt>
    <img src="http://i1065.photobucket.com/albums/u381/jana2511/NL5/MomPreneurs_virtuell_arbeiten_zpsusllhcnu.jpg" alt>
    <img src="http://i1065.photobucket.com/albums/u381/jana2511/NL5/ipad-605439_1920_zpsb04bojgw.jpg" alt>
    <img src="http://i1065.photobucket.com/albums/u381/jana2511/NL4/office-620822_1920-1050x700_zpsgpfln1f2.jpg" alt>
   </figure>
</div>
<script type="text/javascript">
    var timeOnSlide = 4,
    timeBetweenSlides = 1,
    animationstring = 'animation',
    animation = false,
    keyframeprefix = '',
    domPrefixes = 'Webkit Moz O Khtml'.split(' '),
    pfx = '',
    slidy = document.getElementById("slidy");
if (slidy.style.animationName !== undefined) { animation = true; }
if ( animation === false ) {
    for ( var i = 0; i < domPrefixes.length; i++ ) {
    if ( slidy.style[ domPrefixes[i] + 'AnimationName' ] !== undefined ) {
    pfx = domPrefixes[ i ];
    animationstring = pfx + 'Animation';
    keyframeprefix = '-' + pfx.toLowerCase() + '-';
    animation = true;
    break;
    } } }
if ( animation === false ) {
    // fallback
} else {
    var images = slidy.getElementsByTagName("img"),
    firstImg = images[0],
    imgWrap = firstImg.cloneNode(false);
    slidy.appendChild(imgWrap);
      var imgCount = images.length,
      totalTime = (timeOnSlide + timeBetweenSlides) * (imgCount - 1),
      slideRatio = (timeOnSlide / totalTime)*100,
      moveRatio = (timeBetweenSlides / totalTime)*100,
      basePercentage = 100/imgCount,
      position = 0,
        css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML += "#slidy { text-align: left; margin: 0; font-size: 0; position: relative; width: " + (imgCount * 100) + "%; }";
        css.innerHTML += "#slidy img { float: left; width: " + basePercentage + "%; }";
        css.innerHTML += "@"+keyframeprefix+"keyframes slidy {";
for (i=0;i<(imgCount-1); i++) {
      position+= slideRatio;
      css.innerHTML += position+"% { left: -"+(i * 100)+"%; }";
      position += moveRatio;
      css.innerHTML += position+"% { left: -"+((i+1) * 100)+"%; }";
}
  css.innerHTML += "}";
  css.innerHTML += "#slidy { left: 0%; "+keyframeprefix+"transform: translate3d(0,0,0); "+keyframeprefix+"animation: "+totalTime+"s slidy infinite; }";
  document.body.appendChild(css);
}
</script>
  <?php}
}

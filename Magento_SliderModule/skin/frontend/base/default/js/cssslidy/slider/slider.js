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



//append last for inf scroll
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

document.getElementsByTagName('head')[0].appendChild(css);
// instead of document.body.appendChild(css);

// similar for captions

    css2 = document.createElement('style');
    css2.type = "text/css";
    var captions = slidy.getElementsByClassName("cpt"),
    cptCount = captions.length,
    cptPercentage = 100/imgCount;

    for (i=0;i<(cptCount-1); i++) {
      var y = i + 1,
      posLeft =  i  * cptPercentage + 1;
      css2.innerHTML += "#cssslidy-caption" + y + " { left: " + posLeft + "% !important; }";
    }
    //  or:
    //  document.body.appendChild(css2);
    //  document.body.insertBefore(css2,document.body.firstChild);

  document.getElementsByTagName('head')[0].appendChild(css2);

}

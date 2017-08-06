<?php
defined('_JEXEC') or die('Restricted access');

class plgJshoppingProductsJSocial_Share extends JPlugin{
    
    private $locale;
    
    public function __construct(&$subject, $config = array()) {
        parent::__construct($subject, $config);
        
        $lang = JFactory::getLanguage();
        $this->locale = $lang->getTag();
        
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root(true).'/plugins/jshoppingproducts/jsocial_share/jsocial_share.css');
    }
    
    public function onBeforeDisplayProductView(&$view) {  
	$jshopConfig = JSFactory::getConfig();
        $doc = JFactory::getDocument();
        $product = $view->product;
        $name_product = htmlentities($product->name, ENT_QUOTES, "UTF-8");
        $ogurl = '<meta property="og:url" content="'.JURI::current().'"/>';
        //$ogtype = '<meta property="og:type" content="website"/>';
        $ogtitle = '<meta property="og:title" content="'.$name_product.'"/>';
        $doc->addCustomTag($ogurl);
        $doc->addCustomTag($ogtype);
        $doc->addCustomTag($ogtitle);
        if ($product->image){
            $ogimage = '<meta property="og:image" content="'.$jshopConfig->image_product_live_path.'/'.$product->image.'"/>';
            $doc->addCustomTag($ogimage);
        }
        if ($product->description){
            $ogdescription = '<meta property="og:description" content="'.(strip_tags($product->description)).'"/>';
            $doc->addCustomTag($ogdescription);
        }
        $title = 'name_'.$this->locale;
        $uri = JURI::getInstance();
        $url = $uri->getScheme() ."://" . $uri->getHost() . $uri->getPath();
        $view->product->product_full_image = getPatchProductImage($view->product->image, 'full');
        $_tmp_product_html = '';
        $_tmp_product_html .= '<div class="facebook-like-button">'.$this->getFacebookLikeButton($this->params, $url, $name_product).'</div>';
        $_tmp_product_html .= '<div class="facebook-share">'.$this->getFacebookShare($this->params, $url).'</div>';
	$_tmp_product_html .= '<div class="pinterest">'.$this->getPinterestButton($this->params, $url, $jshopConfig->image_product_live_path.'/'.$product->image).'</div>'; 
        $_tmp_product_html .= '<div class="tweet-button">'.$this->getTweetButton($this->params, $url, $name_product).'</div>';
        $_tmp_product_html .= '<div class="google-plus-one-button">'.$this->getGooglePlusOne($this->params, $url).'</div><div style="clear:both;"></div>';		 
        switch ($this->params->get('position', 2)) {
            case 1 :
                $view->_tmp_product_html_start = $_tmp_product_html.$view->_tmp_product_html_start;
                break;
            case 3 :
                $view->_tmp_product_html_end = $_tmp_product_html.$view->_tmp_product_html_end;
                break;
            default:
                $view->_tmp_product_html_after_buttons = $_tmp_product_html.$view->_tmp_product_html_after_buttons;
                break;    
        }
    }
    
    private function getGooglePlusOne($params, $url){
        $html = ''; $annotation = ''; $size = '';
        if($params->get("plusButton")) {
            if ($params->get("plusAnnotation") == 'inline') $annotation = 'annotation="inline"';
            else if ($params->get("plusAnnotation") == 'none') $annotation = 'annotation="none"';
            
            if ($params->get("plusType")) $size = 'size="'. $params->get("plusType", "medium") .'"';
           
            $html = '<script type="text/javascript" src="http://apis.google.com/js/plusone.js"> 
            {lang: "' . $params->get('plusLocale') . '"} </script>';
            if (!$params->get("html5syntax"))
                $html .= '<g:plusone '. $annotation .' ' . $size . '" href="' . $url . '"></g:plusone>';
            else {
                if (!empty($size)) $size = 'data-' . $size;
                if (!empty($annotation)) $annotation = 'data-'.$annotation;
                $html .= '<div class="g-plusone" '. $annotation .' '. $size . '"  data-href="' . $url . '"></div>';
            }
        } 
		
        return $html;
    }

    private function getTweetButton($params, $url, $name_product){
        if ($params->get("twitterButton", 1)){
             $text = array(
                        'en' => 'Tweet',
                        'de' => 'Twittern',
                        'ru' => 'Твитнуть'
            );
            $html = '<a href="https://twitter.com/share" class="twitter-share-button" data-url="'. $url .'" data-text="'. $name_product .'" data-via="'. $params->get('twitterName', '') .'" data-lang="'. $params->get('twitterLanguage', 'en') .'">'. $text[$params->get('twitterLanguage', 'en')] .'</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
            return $html;
        }
    }
    
    private function getFacebookShare($params, $url){
        if ($params->get("facebookShareButton", 1)){
            //added in 4.0.2 version
            $locale = $params->get('facebookLocaleShare', 'en_US');
            if (!$params->get("facebookLikeButton", 1) && !$facebookLikeRenderer){
                $html = '<div id="fb-root"></div>';
            }
            $html .= '<script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/'. $locale .'/all.js#xfbml=1&version=v2.0";
                    fjs.parentNode.insertBefore(js, fjs);
                    }(document, "script", "facebook-jssdk"));</script>';
            $html .= '<fb:share-button href="'. $url .'"'
                    . 'layout="button"</fb:share-button>'; 
                                 
            //old in 4.0.1 version
           // $html = '<script type="text/javascript">var fbShare = {url: "' .$url. '", size: "' .$params->get("facebookShareTextSize", "small"). '", google_analytics: "false"}</script><script src="http://widgets.fbshare.me/files/fbshare.js" type="text/javascript"></script>'; 
            return $html;  
        }  
    }
    
    private function getFacebookLikeButton($params, $url, $product_title){
        if ($params->get("facebookLikeButton", 1)){
            $locale = ($params->get('facebookDynamicLocale', 1)) ? str_replace("-", "_", $this->locale) : $params->get('facebookLocale', 'en_US');
            $height = (strcmp("box_count", $params->get("facebookLayoutStyle","button_count"))==0) ? 80 : 20;
            $facebookLikeRenderer = $params->get('facebookLikeRenderer', 1);
            if (!$facebookLikeRenderer){ //Iframe
                $html = '<iframe src="//www.facebook.com/plugins/like.php?href='.$url.'&amp;
                send=false&amp;
                layout='. $params->get("facebookLayoutStyle","button_count") .'&amp;
                width='. $params->get('facebookLikeWidth', '100') .'&amp;
                show_faces='. $params->get('facebookShowFaces', 'false') .'&amp;
                action='. $params->get('facebookVerbToDisplay', 'like') .'&amp;
                colorscheme='. $params->get('facebookColorScheme', 'light') .'&amp;
                font='. $params->get('facebookLikeFont', 'arial') .'&amp;
                height='. $height .'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; 
                width:'. $params->get('facebookLikeWidth', '100') .'px; 
                height:'. $height .'px;" allowTransparency="true"></iframe>';                
            }else{   
                $html = '<div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/'. $locale .'/all.js#xfbml=1";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, "script", "facebook-jssdk"));</script>';    

                if($facebookLikeRenderer == 1){//XFBML
                     $html .= '<fb:like href="'. $url .'" 
                            send="'. $params->get('facebookSendButton', 'false') .'" 
                            layout="'. $params->get("facebookLayoutStyle","button_count") .'" 
                            width="'. $params->get('facebookLikeWidth', '100') .'" 
                            show_faces="'. $params->get('facebookShowFaces', 'false') .'" 
                            font="'. $params->get('facebookLikeFont', 'arial') .'"
                            action="'. $params->get('facebookVerbToDisplay', 'like') .'"
                            colorscheme="'. $params->get('facebookColorScheme', 'light') .'"> 
                         </fb:like>';  
                }else{//HTML5 
                    $html .= '<div class="fb-like" data-href="'. $url .'" 
                            data-send="'. $params->get('facebookSendButton', 'false') .'" 
                            data-layout="'. $params->get("facebookLayoutStyle","button_count") .'" 
                            data-width="'. $params->get('facebookLikeWidth', '100') .'" 
                            data-show-faces="'. $params->get('facebookShowFaces', 'false') .'" 
                            data-font="'. $params->get('facebookLikeFont', 'arial') .'"
                            data-action="'. $params->get('facebookVerbToDisplay', 'like') .'"
                            data-colorscheme="'. $params->get('facebookColorScheme', 'light') .'">
                         </div>';     
                } 
            }
			
			return $html;
        }
    }
	
	private function getPinterestButton($params, $url, $imageUrl){
		$html = '';
		if ($params->get("pinterestButton", 1)){
			$html .= '<a href="http://pinterest.com/pin/create/button/?url='.$url.'&media='.$imageUrl.'" class="pin-it-button" count-layout="none"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';
			$html .= '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';
		}
		return $html;
	}
	

}
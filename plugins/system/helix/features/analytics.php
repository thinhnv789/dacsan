<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
//no direct accees
defined ('_JEXEC') or die('resticted aceess');

class HelixFeatureAnalytics{
    
    private $helix;
    
    public function __construct($helix){
        $this->helix = $helix;
    }
	
    public function onHeader()
    {
        
    }
	
    public function onFooter()
    {
        ob_start();
        ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '<?php echo $this->helix->Param('ga_code') ?>', 'auto');
            ga('send', 'pageview');

        </script>
        <?php
        $data = ob_get_contents();
        ob_end_clean();
        $code = $this->helix->Param('ga_code');
        if( $this->helix->Param('enable_ga', 0) and !empty($code) ) return $data;
    }
    
    
	public function Position()
	{
				
	}
    

	public function onPosition()
	{		
		
	}	
}

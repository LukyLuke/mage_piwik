<?php

class Delight_Piwik_Block_Page_Head extends Mage_Page_Block_Html_Head {

	public function getCssJsHtml() {
		$html = parent::getCssJsHtml();

		if (!Mage::getStoreConfig('web/piwik/enabled')) {
			return $html;
		}

		$_piwikUrl = parse_url( Mage::getStoreConfig('web/piwik/piwik_url') );
		$piwikUrl = $_piwikUrl['host'].(array_key_exists('port', $_piwikUrl) ? ':'.$_piwikUrl['port'] : '').preg_replace('/[\/]+/smi', '/', (array_key_exists('path', $_piwikUrl) ? $_piwikUrl['path'].'/' : '/'));
		$piwikId = Mage::getStoreConfig('web/piwik/site_id');

		return $html.'<script type="text/javascript">
	var pkBaseURL = (("https:" == document.location.protocol) ? "https://'.$piwikUrl.'" : "http://'.$piwikUrl.'");
	document.write(unescape("%3Cscript src=\'" + pkBaseURL + "piwik.js\' type=\'text/javascript\'%3E%3C/script%3E"));
</script><script type="text/javascript">
try { var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", '.$piwikId.'); } catch( err ) { if (console) console.error(err); }
</script>';
	}

}

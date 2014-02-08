<?php

class Delight_Piwik_Block_Page_Footer extends Mage_Page_Block_Html_Footer
{
	public function _toHtml() {
		$html = parent::_toHtml();

		if (!Mage::getStoreConfig('web/piwik/enabled')) {
			return $html;
		}
		$_piwikUrl = parse_url( Mage::getStoreConfig('web/piwik/piwik_url') );
		$piwikUrl = $_piwikUrl['host'].(array_key_exists('port', $_piwikUrl) ? ':'.$_piwikUrl['port'] : '').preg_replace('/[\/]+/smi', '/', (array_key_exists('path', $_piwikUrl) ? $_piwikUrl['path'].'/' : '/'));
		$piwikId = Mage::getStoreConfig('web/piwik/site_id');

		$piwik = '<script type="text/javascript">
try { piwikTracker.enableLinkTracking(); piwikTracker.trackPageView(); } catch( err ) { if (console) console.error(err); }
</script><noscript><p><img src="'.$piwikUrl.'/piwik.php?idsite='.$piwikId.'" style="border:0" alt="" /></p></noscript>';
		return $html.$piwik;
	}
}

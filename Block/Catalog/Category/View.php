<?php

class Delight_Piwik_Block_Catalog_Category_View extends Mage_Catalog_Block_Category_View {
	protected function _toHtml() {
		$html = parent::_toHtml();

		if (!Mage::getStoreConfig('web/piwik/enabled')) {
			return $html;
		}

		$_helper    = $this->helper('catalog/output');
    	$_category  = $this->getCurrentCategory();
		return $html.'
<!-- Piwik -->
<script type="text/javascript">
try {
	piwikTracker.setEcommerceView(
		false, // No Product on CategoryPage
		false, // No Product on CategoryPage
		"'.$_helper->categoryAttribute($_category, $_category->getName(), 'name').'" // Category Page
	);
} catch (err) {if (console) console.error(err);}
</script>
<!-- Piwik -->';
	}
}

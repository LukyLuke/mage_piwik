<?php

class Delight_Piwik_Block_Catalog_Product_View extends Mage_Catalog_Block_Product_View {
	public function getPriceHtml($product, $displayMinimalPrice = false, $idSuffix = '') {
		$html = parent::getPriceHtml($product, $displayMinimalPrice, $idSuffix);

		if (!Mage::getStoreConfig('web/piwik/enabled')) {
			return $html;
		}

		$_helper = $this->helper('catalog/output');
		$_category = Mage::registry('current_category');
		$_product = $this->getProduct();
		return $html.'
<!-- Piwik -->
<script type="text/javascript">
try {
	piwikTracker.setEcommerceView(
		"'.$_product->getSku().'", // (required) SKU: Product unique identifier
		"'.$_product->getName().'", // (optional) Product name
		"'.(!is_null($_category) ? $_helper->categoryAttribute($_category, $_category->getName(), 'name') : '').'" // (optional) Product category
	);
} catch (err) {if (console) console.error(err);}
</script>
<!-- Piwik -->';
	}
}
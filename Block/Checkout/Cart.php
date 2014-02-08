<?php

class Delight_Piwik_Block_Checkout_Cart extends Mage_Checkout_Block_Cart {
	protected function _toHtml() {
		$html = parent::_toHtml();

		if (!Mage::getStoreConfig('web/piwik/enabled')) {
			return $html;
		}

		$_helper = $this->helper('catalog/output');
		$html .= '
<!-- Piwik -->
<script type="text/javascript">
try {
';
		foreach ($this->getItems() as $item) {
			$html .= '	piwikTracker.addEcommerceItem(
		"'.$item->getSku().'", // (required) SKU: Product unique identifier
		"'.$item->getName().'", // (optional) Product name
		"", // (optional) Product category
		parseFloat("'.$item->getCalculationPrice().'"), // (recommended) Product price
		'.$item->getQty().' // (optional, default to 1) Product quantity
	);';
		}
		$totals = 0.0;
		foreach($this->getTotals() as $total) {
			if ($total->getArea() != 'footer') continue;
			$totals += (float)($total->getAddress()->getGrandTotal());
		}

		return $html.'
	piwikTracker.trackEcommerceCartUpdate(
		parseFloat("'.$totals.'") // (recommended) Cart amount
	);
} catch (err) {if (console) console.error(err);}
</script>
<!-- Piwik -->';
	}
}
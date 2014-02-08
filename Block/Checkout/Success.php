<?php

class Delight_Piwik_Block_Checkout_Success extends Mage_Checkout_Block_Success {
	protected function _toHtml() {
		$html = parent::_toHtml();

		if (!Mage::getStoreConfig('web/piwik/enabled')) {
			return $html;
		}

		$order = Mage::getModel('sales/order')->loadByIncrementId($this->getOrderId());
		$items = $order->getAllItems();

		$html .= '
<!-- Piwik -->
<script type="text/javascript">
try {
';
		foreach ($items as $item) {
			$html .= '	piwikTracker.addEcommerceItem(
		"'.$item->getSku().'", // (required) SKU: Product unique identifier
		"'.$item->getName().'", // (optional) Product name
		"", // (optional) Product category
		'.$item->getPrice().', // (recommended) Product price
		'.$item->getQtyOrdered().' // (optional, default to 1) Product quantity
	);';
		}

		$shippingCoast = 0.0;
		$tax = 0.0;
		$discount = 0.0;
		$total = $order->getGrandTotal();
		foreach ($order->getInvoiceCollection() as $invoice) {
			$total = $invoice->getGrandTotal();
			$shippingCoast = $invoice->getShippingAmmount();
			$tax = $invoice->getTaxAmmount();
			$discount = 0.00-$invoice->getDiscountAmmount();
			break;
		}

		return $html.'	piwikTracker.trackEcommerceOrder(
		'.$this->getOrderId().', // (required) Unique Order ID
		'.$total.', // (required) Order Revenue grand total (includes tax, shipping, and subtracted discount)
		'.($total-$shippingCoast).', // (optional) Order sub total (excludes shipping)
		'.$tax.', // (optional) Tax amount
		'.$shippingCoast.', // (optional) Shipping amount
		'.$discount.' // (optional) Discount offered (set to false for unspecified parameter)
	);
} catch (err) {if (console) console.error(err);}
</script>
<!-- Piwik -->';
	}
}
<?php
// Redirection
function redirect($url = null) {
	if(is_null($url)) $url = $_SERVER['PHP_SELF'];
	header("Location: $url");
	exit();
}

function esc_attr($string) {
	//$string = htmlspecialchars($string, ENT_QUOTES);
	return str_replace('\\', '', $string);
}

// Slug
function slug($string) {
	return str_replace('--', '', preg_replace("/[^A-Za-z0-9]/", "-", strtolower($string)));
}

function paypal_redirect($paypal) {

	// Initialisation des paramètres pour SetExpressCheckout
	$params = array(
		'RETURNURL' => BASEURL.'/paiement-confirmation.php', // redirection en cas de succès
		'CANCELURL' => BASEURL.'/paiement-annulation.php', // redirection en cas d'annulation
		'PAYMENTREQUEST_0_AMT' => $_SESSION['panier']['total_ttc'], // prix total de la commande
		'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR', // monnaie
		'LOCALECODE' => 'FR'
	);
	
	// On initialise le paiement
	$response = $paypal->request('SetExpressCheckout', $params);
	
	/* tout est ok */
	if ($response) {
		// Redirection Paypal
		redirect('https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token=' . $response['TOKEN']);
	} else {
		/* erreur */
		var_dump($paypal->errors);
		die();
	}
}
?>
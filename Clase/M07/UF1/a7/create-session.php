<?php
require ("funcciones.php");
require 'stripe/stripe-php-master/init.php';

\Stripe\Stripe::setApiKey('sk_test_51HoC71IphK9Qq3yqQheK5Q5MtdhDImxzDKamQKlNEs0vZV01g1tzmDmC3LlU6VzIwx0fu8umLEeojSxmyoPJT8cR00b6v2jqul');

header('Content-Type: application/json');

if (!isset($_SESSION["control"])){
    header("Location: login.php?error=1");
}
$_SESSION["id_comanda"]="";
$_SESSION["identificadorCompraPrivadaKo"]=randomPassword(99);

$_SESSION["identificadorCompraPublica"]=randomPassword();
$_SESSION["identificadorCompraPrivada"]=randomPassword(99);
while(comprovarIdPrivado($_SESSION["identificadorCompraPrivada"])==true){
  $_SESSION["identificadorCompraPrivada"]=randomPassword(99);  
}

$YOUR_DOMAIN = 'http://dawjavi.insjoaquimmir.cat';
$precio=0;
foreach ($_SESSION["carritoUser"] as $value){
  $precio+=buscarPrecio($value);
  $precio=intval(str_replace(',','.',$precio));
}
$precioFinal=($precio*100);

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => $precioFinal,
      'product_data' => [
        'name' => 'MOHA LA TIENDA DE CONFINAZA REFERENCIA DE LA COMPRA: '.$_SESSION["identificadorCompraPublica"],
        'images' => ["https://i.imgur.com/EHyR2nP.png"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/mboughima/Clase/M07/UF1/a7/compraOk.php?id_comanda='.$_SESSION["identificadorCompraPrivada"],
  'cancel_url' => $YOUR_DOMAIN . '/mboughima/Clase/M07/UF1/a7/compraKo.php?id_comanda='.$_SESSION["identificadorCompraPrivada"].'&ko_id='.$_SESSION["identificadorCompraPrivadaKo"],
]);

echo json_encode(['id' => $checkout_session->id]);
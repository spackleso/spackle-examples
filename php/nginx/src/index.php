<?php
require_once __DIR__ . "/vendor/autoload.php";

function request_path()
{
    $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    $script_name = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
    $parts = array_diff_assoc($request_uri, $script_name);
    if (empty($parts))
    {
        return '/';
    }
    $path = implode('/', $parts);
    if (($position = strpos($path, '?')) !== FALSE)
    {
        $path = substr($path, 0, $position);
    }
    return $path;
}

$path = request_path();

if ($path == 'customers') {
  header('Content-Type: application/json; charset=utf-8');
  \Spackle\Spackle::setApiKey($_POST['api_key']);
  $start = microtime(true);
  $customer = \Spackle\Customer::retrieve($_POST['customer_id']);
  $end = microtime(true);
  echo json_encode(
    array(
      "customer" => $customer->data,
      "time" => $end - $start,
    )
  );
} elseif ($path == 'pricing-table') {
  header('Content-Type: application/json; charset=utf-8');
  \Spackle\Spackle::setApiKey($_POST['api_key']);
  $table = \Spackle\PricingTable::retrieve($_POST['pricing_table_id']);
  echo json_encode($table);
} else {
  readfile('templates/index.html');
}
?>

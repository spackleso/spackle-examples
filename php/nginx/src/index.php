<?php
require_once __DIR__ . "/vendor/autoload.php";

\Spackle\Spackle::setApiKey(getenv('SPACKLE_API_KEY'));
\Spackle\Spackle::setSSLEnabled(false);

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
  $start = microtime(true);
  $customer = \Spackle\Customer::retrieve($_POST['customer_id']);
  $end = microtime(true);
  echo json_encode(
    array(
      "customer" => $customer->data,
      "time" => $end - $start,
    )
  );
} else {
  readfile('templates/index.html');
}
?>

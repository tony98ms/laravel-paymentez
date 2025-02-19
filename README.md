# Laravel Paymentez
[![Latest Stable Version](https://img.shields.io/packagist/v/tonystore/laravel-paymentez?include_prereleases&label=version&color=%23assds)](https://packagist.org/packages/tonystore/laravel-paymentez) 
[![Packagist Downloads](https://img.shields.io/packagist/dt/tonystore/laravel-paymentez)](https://packagist.org/packages/tonystore/laravel-paymentez)
[![License](https://img.shields.io/packagist/l/tonystore/laravel-paymentez)](https://packagist.org/packages/tonystore/laravel-paymentez) 
[![PHP Version Require](https://img.shields.io/packagist/dependency-v/tonystore/laravel-paymentez/php)](https://packagist.org/packages/tonystore/livewire-permission)

Esta librería de Laravel permite integrarse fácilmente con las APIs de [Paymentez](https://www.nuvei.com.ec), proporcionando una forma sencilla de realizar operaciones como pagos, consultas de transacciones, entre otras.

## Instalación y Configuración

1. Instala la librería usando Composer:

```bash
   composer require tonystore/laravel-paymentez
```

2. Publica el archivo de configuración ejecutando:

```bash
  php artisan vendor:publish --provider="TonyStore\LaravelPaymentez\LaravelPaymentezProvider"
```
Esto generará un archivo `config/paymentez.php` donde podrás ajustar las configuraciones.

3. Agrega las siguientes variables a tu archivo .env:

```env
PAYMENTEZ_API_CODE=your-auth-code
PAYMENTEZ_API_KEY=your-auth-key
```

- `PAYMENTEZ_API_CODE`: Código de autenticación proporcionado por Paymentez.
- `PAYMENTEZ_API_KEY`: Llave de autenticación para conectarse a las APIs.

4. Ejemplo de archivo de configuración generado (`config/paymentez.php`):

```php 
<?php 

return [
    'auth_code' => env('PAYMENTEZ_API_CODE', ''),

    'auth_key' => env('PAYMENTEZ_API_KEY', ''),

    'base_url' => [
        'ccapi' => env('PAYMENTEZ_CCAPI_URL'),
        'noccapi' =>  env('PAYMENTEZ_NOCCAPI_URL')
    ],
];
```
### Recursos disponibles:

- `PaymentezCard`:
 _getList_, _delete_
- `PaymentezCharge`:
 create, authorize, capture, verify, refund

## Formas de uso
### Obtener una lista de tarjetas por usuario
```php 
<?php 
use TonyStore\LaravelPaymentez\Facades\PaymentezCard;


$uid = '23';
$cards = PaymentezCard::getList($uid);

```

### Eliminar una tarjeta con token
```php 
<?php 
use TonyStore\LaravelPaymentez\Facades\PaymentezCard;


$uid = '23';
$token = '785896526632'
PaymentezCard::delete($token, ["id" => (string)$uid]);

```
 ### Crear nuevo cargo con token
```php 
<?php 
use TonyStore\LaravelPaymentez\Facades\PaymentezCard;


$cardToken = "myAwesomeTokenCard";

$userDetails = [
    'id' => "23", 
    'email' => "jhondoe@gmail.com" 
];

$orderDetails = [
    'amount' => 100.00, 
    'description' => "XXXXXX",
    'dev_reference' => "XXXXXX", 
    'vat' => 0.00 
];

$created = PaymentezCharge::create($cardToken, $orderDetails, $userDetails);

$object = $created->toObject(); //Obtener la respuesta en formato objeto simple
$collection = $created->toCollection(); //Obtener la respuesta en una colección
$array = $created->toArray(); //Obtener la respuesta en un arreglo
$response = $created->toResponse(); // Obtener instancia de Response

// Obtener información de la respuesta

// Estado
$status = $object->transaction->status;

// Id de la transacción
$transactionId = $object->transaction->id;
```
 
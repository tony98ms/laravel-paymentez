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

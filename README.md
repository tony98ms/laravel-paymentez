# Laravel Paymentez Library
[![Latest Stable Version](https://img.shields.io/packagist/v/blubear/laravel-paymentez)](https://packagist.org/packages/blubear/laravel-paymentez) 
[![Packagist Downloads](https://img.shields.io/packagist/dt/blubear/laravel-paymentez)](https://packagist.org/packages/blubear/laravel-paymentez)
[![License](https://img.shields.io/packagist/l/blubear/laravel-paymentez)](https://packagist.org/packages/blubear/laravel-paymentez) 
[![PHP Version Require](https://img.shields.io/packagist/dependency-v/blubear/laravel-paymentez/php)](https://packagist.org/packages/tonystore/livewire-permission)

Esta librería de Laravel permite integrarse fácilmente con las APIs de [Paymentez](https://paymentez.com/), proporcionando una forma sencilla de realizar operaciones como pagos, consultas de transacciones, entre otras.

## Instalación y Configuración

1. Instala la librería usando Composer:

```bash
   composer require blubear/laravel-paymentez
```

2. Publica el archivo de configuración ejecutando:

```bash
  php artisan vendor:publish --provider="Blubear\LaravelPaymentez\LaravelPaymentezProvider"
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

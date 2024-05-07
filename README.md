# lexontech-authenticationSystem
## leila.akbari1996@gmail.com
### This is a authentication platform with sanctum.

## Getting Started

## step1:

composer require lexontech/authentication-system:"dev-main"

## step2:
bootstrap/providers.php

return [

  ...,
  
  \Lexontech\AuthenticationSystem\AuthServiceProvider::class,
  
]

## step3:

  php artisan vendor:publish --tag
  

## step4:

  php artisan migrate

## step5:

 php artisan db:seed



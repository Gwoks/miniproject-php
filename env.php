<?php
  $variables = [
      'DB_HOST' => 'localhost',
      'DB_USERNAME' => 'root',
      'DB_PASSWORD' => 'namasaya',
      'DB_NAME' => 'flip',
      'SECRET_KEY' => 'HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41',
      'BASE_URL' => 'https://nextar.flip.id/',
      'DISBURSE_URL' => 'disburse/'
  ];

  foreach ($variables as $key => $value) {
      putenv("$key=$value");
  }
?>
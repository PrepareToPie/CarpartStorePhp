<?php

// Init Framework
require_once '../src/core/init.php';


// Process request with using of models
$user = get_authorized_user();


  // Give Response
if ($user !== NULL) {
  $data = [
      'profile' => $user,
  ];
  load_view('user', $data);
} else {
  error403();
}
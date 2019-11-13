<?php
 require_once dirname(__FILE__).'/omise-php/lib/Omise.php';

 define('OMISE_PUBLIC_KEY', 'pkey_test_5d7lyhsv0dn5o72optj');
 define('OMISE_SECRET_KEY', 'skey_test_5d7lyhsvjgl7b7o48o2');
 define('OMISE_API_VERSION', '2017-11-02');

    $charge = OmiseCharge::create(array(
      'amount'   => $_POST["description"],
      'currency' => 'thb',
      'card'     => $_POST["omiseToken"]

    ));
/*
if (isset($_POST['omiseSource'])) { // for alternative payment methods
  $internet = OmiseSource::create(array(
    'amount'   => $_POST["description"],
    'currency' => 'thb',
    'source'     => $_POST["omiseSource"], 
    'type' => 'internet_banking_scb',
    'flow' => 'redirect'
 
  ));
    
     echo '<pre>';
       print_r($internet);
      echo '</pre>';
      echo'<hr>'; 

}
*/

    
     echo '<pre>';
       print_r($charge);
      echo '</pre>';
      echo'<hr>';




/*
  echo '<pre>';
   print_r($charge);
  echo '</pre>';
  echo'<hr>';

*/

?>
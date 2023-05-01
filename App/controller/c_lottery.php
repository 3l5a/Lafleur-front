<?php 

include_once 'App/model/M_Lottery.php';

switch($action) {
    case 'play':
        var_dump($prizes);
        var_dump(gettype(json_encode($prizes)));
        var_dump(json_encode($prizes));
        break;
    default:
        break;
}
<?php
require_once 'db_connection.php';

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function select($tablename, $orderby){
  $result = pg_query($GLOBALS['dbconn'], "SELECT * FROM $tablename ORDER BY $orderby ASC;");
  if($result){
    return pg_fetch_all($result);
  }
}

function insert($arr, $tablename){
  if(isset($arr['title']))
    $arr['title'] = strtoupper($arr['title']);
  $result = @pg_insert($GLOBALS['dbconn'], $tablename, $arr);
  if($result){
    $last = pg_query($GLOBALS['dbconn'], "SELECT * FROM $tablename ORDER BY id$tablename DESC LIMIT 1;");
    return pg_fetch_array($last);
  } else {
    return null;
  }
}

function delete($arr, $tablename){
  $result = pg_delete($GLOBALS['dbconn'], $tablename, $arr); 
}

function selectItemById($id){
  $result = pg_query("SELECT * FROM item NATURAL JOIN type_item WHERE iditem = $id");
  if($result){
    return pg_fetch_assoc($result);
  } else {
    return null;
  }
}

function addOrder($order, $itens){
  $result = @pg_insert($GLOBALS['dbconn'], "order_register", $order);
  if($result == true) {
    $aux = pg_query($GLOBALS['dbconn'], "SELECT idorder_register FROM order_register ORDER BY idorder_register DESC LIMIT 1;");
    $idorder_register = pg_fetch_result($aux, "idorder_register");
    for($i = 0; $i < count($itens); $i++){
      unset($itens[$i]['idtype_item']);
      unset($itens[$i]['title']);
      unset($itens[$i]['descr']);
      unset($itens[$i]['tax']);
      $itens[$i]["idorder_register"] = $idorder_register;
      @pg_insert($GLOBALS['dbconn'], "item_order", $itens[$i]);
    }
    return true;
  } else {
    return false;
  }
}
?>
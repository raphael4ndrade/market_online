<?php
include 'header.php';
require_once 'db/db_services.php';
$orders = select("order_register", "idorder_register");

?>

<div class="my-content">
  <div class="level" style="margin: 10px 0px;">
    <div class="level-left">
      <form action="index.php" method="GET">
        <input type="submit" class="button is-info" value="VOLTAR"/>
      </form>
    </div>  
  </div>
  <div class="columns">
    <div class="label column is-2 centered border-bottom" >ID</div>
    <div class="label column centered border-bottom">Data</div>
    <div class="label column centered border-bottom">Total (R$)</div>
    <div class="label column centered border-bottom" style="margin-bottom: 8px;">Impostos (R$)</div>
  </div>
  <?php
  for($i=0; $i < count($orders); $i++){
    echo "<div class='columns'>" .
            "<div class='column is-2 centered border-bottom'>" . $orders[$i]['idorder_register'] ."</div>"  .
            "<div class='column centered border-bottom'>" . $orders[$i]['dtreg'] ."</div>" .
            "<div class='column centered border-bottom'>" . $orders[$i]['total_amount'] ."</div>" .
            "<div class='column centered border-bottom'>" . $orders[$i]['total_tax'] ."</div>" .
        "</div>";    
  }
  ?>
  
</div>
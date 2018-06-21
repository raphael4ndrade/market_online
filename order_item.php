<?php
include 'header.php';

require_once 'db/db_services.php';

session_start();

if(!isset($_SESSION['order']) || !isset($_SESSION['order_register'])){
  $_SESSION['order'] = [];
  $_SESSION['order_register'] = ["total_amount"=>0.0, "total_tax"=>0.0];
}

$item = "item";
$itens = select($item, "descr");
$itens_order = $_SESSION['order'];

function orderValues($field){
  if(isset($_SESSION['order_register']))
    return $_SESSION['order_register'][$field];
  return 0.0;
}

if($_POST){
  if(isset($_POST['clean'])){
    unset($_SESSION['order']);
    unset($_SESSION['order_register']);
    $itens_order = [];
  }
  
  if(isset($_POST['add_item'])){
    $result = selectItemById($_POST['iditem']);
    $result["quantity"] = $_POST['quantity'];
    $result["total_amount"] = $_POST['quantity'] * $result['price'];
    $result["total_tax"] = $result["tax"] / 100 * $result["total_amount"];
    
    $_SESSION['order_register']['total_amount'] += $result['total_amount'];
    $_SESSION['order_register']['total_tax'] += $result['total_tax'];
    array_push($_SESSION['order'], $result);
    $itens_order = $_SESSION['order'];
  }
  
  if(isset($_POST['remove_item'])){
    $aux = test_input($_POST['iditem']);
    
    if(!empty($aux) == true){
      array_splice($_SESSION['order'], ($aux -1), 1);
      $itens_order = $_SESSION['order'];
      $_SESSION['order_register'] = ["total_amount"=>0.0, "total_tax"=>0.0];
      
      for($i=0; $i < count($itens_order); $i++){
        $_SESSION['order_register']['total_amount'] += $itens_order[$i]['total_amount'];
        $_SESSION['order_register']['total_tax'] += $itens_order[$i]['total_tax'];
      }
    }
  }
  
  if(isset($_POST['add_order'])){
    $status = null;
    if((isset($_SESSION['order_register']) && $_SESSION['order_register']['total_amount'] != 0) && isset($_SESSION['order']))
      $status = addOrder($_SESSION['order_register'], $_SESSION['order']);
    if($status == true){
      unset($_SESSION['order']);
      unset($_SESSION['order_register']);
      $itens_order = [];
    }
  }
  

}
?>
<div class="my-content">
  <div class="level" style="margin: 10px 0px;">
    <div class="level-left">
      <form action="index.php" method="POST">
        <input type="submit" class="button is-info" value="VOLTAR"/>
      </form>
    </div>
    
    <div class="level-right">
      <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="submit" class="button is-danger" value="ESVAZIAR LISTA" name="clean"/>
      </form>
    </div>
  </div>


  <h4>NOVO PEDIDO</h4>

  <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="row">
    <div class="align">
      <label class="label">Item</label>
      <div class="select">
        <select name="iditem" required>
          <?php for($i=0; $i < count($itens); $i++){ ?>
            <option value="<?php echo$itens[$i]['iditem'];?>"><?php echo $itens[$i]['descr'];?></option>
          <?php }; ?>
        </select>
      </div>
      </div>
    <div class="align">
      <label class="label">Quantidade</label>
      <div class="control">
        <input class="input" type="number" step="1" min="1" name="quantity" value="1" required/>
      </div>
    </div>

    <div class="control" style="margin-top: 32px;">
      <input class="button is-info" type="submit" value="ADICIONAR" name="add_item"/>
    </div>    
  </form>


  <div class="columns">
    <div class="column border-bottom">ID</div>
    <div class="column is-5 border-bottom">Item</div>
    <div class="column centered border-bottom">Qtd</div>
    <div class="column centered border-bottom">Preço (Un)</div>
    <div class="column centered border-bottom">Total (R$)</div>
    <div class="column centered border-bottom">Imposto (%)</div>
    <div class="column centered border-bottom">Imposto (R$)</div>
  </div>
  <?php
    for($i=0; $i < count($itens_order); $i++){
      echo  "<div class='columns'>" .
              "<div class='column border-bottom'>" . ($i + 1) . "</div>" .
              "<div class='column is-5 border-bottom'>" . $itens_order[$i]['descr'] . "</div>" .
              "<div class='column centered border-bottom'>" . $itens_order[$i]['quantity'] . "</div>" .
              "<div class='column centered border-bottom'>" . $itens_order[$i]['price'] . "</div>" . 
              "<div class='column centered border-bottom'>" . $itens_order[$i]['total_amount'] . "</div>" .
              "<div class='column centered border-bottom'>" . $itens_order[$i]['tax'] . "</div>" .
              "<div class='column centered border-bottom'>" . $itens_order[$i]['total_tax'] . "</div>" .
            "</div>";
    }
  ?>

  <div class="columns">
    <span class="column"></span>
    <span class="column is-5"></span>
    <span class="column"></span>
    <span class="column"></span>
    <div class="label column centered"><?php echo orderValues('total_amount');?></div>
    <span class="column"></span>
    <div class="label column centered"><?php echo orderValues('total_tax');?></div>
  </div>
    
  
  <div class="columns">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="column start">
      <div class="columns">
        <label class="label centered" style="widht:50px !important;">ID:</label>
        <div class="column"> 
          <input class="input" type="number" step="1" min="0" name="iditem"/>
        </div>
        <div class="column">
          <input class="button is-info" type="submit" value="REMOVER" name="remove_item"/>
        </div>
      </div>
    </form>
    
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="column end">
      <input class="button is-info" type="submit" value="FINALIZAR PEDIDO" name="add_order"/>
    </form>
  </div>
</div>
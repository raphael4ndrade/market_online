<?php

include 'header.php';
require_once 'db/db_services.php';

$tablename = "item";
$types = select("type_item", "title");
$itens = select($tablename, "id$tablename");

$descr = $descr_err = $price = $price_err = $id_err = "";

if($_POST){
  if(isset($_POST['new_item'])){
    $aux_descr = test_input($_POST['descr']);
    $aux_price = test_input($_POST['price']);

    if(empty($aux_descr))
      $descr_err = "Insira uma descrição válida.";

    if(empty($aux_price))
      $price_err = "Insira um preço válido.";

    if(!empty($aux_descr) && !empty($aux_price))
      $itens[] = insert(["descr"=>$aux_descr,"price"=>$aux_price,"idtype_item"=>$_POST['idtype_item']], $tablename);

  } 
    
  if(isset($_POST['delete_item'])){
    $aux_id = test_input($_POST['iditem']);
    
    if(empty($aux_id)){
      $id_err = "Insira um ID válido.";
    }else {
      delete(["iditem"=>$aux_id], $tablename);
      $itens = select($tablename, "id$tablename");
    }
  }
}
?>
<div class="my-content">
  <div class="level" style="margin: 10px 0px;">
    <div class="level-left">
      <div class="level-item">
        <form action="type_item.php" method="POST">
          <input value="CADASTRAR TIPO DE ITEM" type="submit" class="button is-info"/>
        </form>
      </div>
    </div>
    
    <div class="level-right">
      <div class="level-item">
        <form action="history.php">
          <input value="HISTÓRICO DE PEDIDOS" type="submit" class="button"/>
        </form>
      </div>
      <div class="level-item">
        <form action="order_item.php" method="POST">
          <input value="NOVO PEDIDO" type="submit" class="button is-info"/>
        </form>
      </div>
    </div>
  </div>
  
  <div class="columns">
  <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="half column">
    <h4>ADICIONAR ITEM</h4>
    <div class="field">
      <label class="label">Descrição</label>
      <div class="control">
        <input class="input <?php echo (strlen($descr_err) == 0) ? "" : "is-danger";?>" name="descr" type="text"/>
      </div>
      <p class="help is-danger"><?php echo $descr_err; ?></p>
    </div>
    <div class="field">
      <label class="label">Preço</label>
      <div class="control">
        <input class="input <?php echo (strlen($price_err) == 0) ? "" : "is-danger";?>" name="price" type="number" step="0.01" min="0"/>
      </div>
      <p class="help is-danger"><?php echo $price_err; ?></p>
    </div>
    <div class="field">
      <label class="label">Tipo</label>
      <div class="control">
        <div class="select">
          <select name="idtype_item" required>
            <?php for($i = 0; $i < count($types); $i++){
                    echo '<option value="' . $types[$i]['idtype_item'] . '">' . $types[$i]['title'] . '</option>';
                  }    
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="control">
      <button class="button is-info" type="submit" name="new_item">SALVAR</button>
    </div>
  </form>
  
  <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="half column">
    <h4>REMOVER ITEM</h4>
    <div class="field">
      <label class="label">ID:</label>
      <div class="control">
        <input class="input  <?php echo empty($id_err) ? "" : "is-danger";?>" type="number" min="0" name="iditem"/>
      </div>
      <p class="help is-danger"><?php echo $id_err; ?></p>
    </div>
    <div class="control">
      <input type="submit" class="button is-danger" name="delete_item" value="EXCLUIR"/>
    </div>
  </form>
</div>
  
<h4>ITENS</h4>
<div class="columns">
  <div class="label column ">ID</div>
  <div class="label column is-6">Descrição</div>
  <div class="label column is-4">Preço</div>
</div>
<?php
  for($i=0; $i < count($itens); $i++){
    echo  "<div class='columns'>" .
            "<div class='column'>" . $itens[$i]['iditem'] . "</div>" .
            "<div class='column is-6'>" . $itens[$i]['descr'] . "</div>" .
            "<div class='column is-4'>" . $itens[$i]['price'] . "</div>" .
          "</div>";
  }
?>

  
</div>
<?php 
include 'header.php';

require_once 'db/db_services.php';

$title = $tax = $title_err = $tax_err =  $id_err = "";
$tablename = "type_item";

$type_itens = select($tablename, "id$tablename");

if($_POST){
  if(isset( $_POST["new_type"])){
    $aux_title = test_input($_POST['title']);
    $aux_tax = test_input($_POST['tax']);
    
    if(empty($aux_title))
      $title_err = "Insira um título válido.";
    
    if(empty($aux_tax))
      $tax_err = "Insira um valor válido.";
    
    if(!empty($aux_title) && !empty($aux_tax))
      $type_itens[] = insert(["title"=>$aux_title, "tax"=>$aux_tax], $tablename);
  }
  
  if(isset($_POST["delete_type"])) {
    $aux_id = test_input($_POST['idtype_item']);
    
    if(empty($aux_id)){
      $id_err = "Insira um ID válido.";
    }else{
      delete(["idtype_item"=>$aux_id], $tablename);
      $type_itens = select($tablename);
    }
  }
}
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
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="half column">
      <h4>ADICIONAR TIPO DE ITEM</h4>
      <div class="field">
        <label class="label">Título</label>
        <div class="control">
          <input class="input <?php echo (strlen($title_err) == 0) ? "" : "is-danger";?>" name="title" type="text"/>
        </div>
        <p class="help is-danger"><?php echo $title_err;?></p>
      </div>
      <div class="field">
        <label class="label">Imposto</label>
        <div class="control">
          <input class="input <?php echo (strlen($tax_err) == 0) ? "" : "is-danger";?>" name="tax" type="number" step="0.01" min="0"/>
        </div>
        <p class="help is-danger"><?php echo $tax_err;?></p>
      </div>
      <div class="control">
        <input class="button is-info" type="submit" name="new_type" value="SALVAR"/>
      </div>
    </form>

    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="half column">
      <h4>REMOVER TIPO DE ITEM</h4>
      <div class="field">
        <label class="label">ID:</label>  
        <div class="control">
          <input class="input <?php echo empty($id_err) ? "" : "is-danger";?>"  type="number" min="0" name="idtype_item" step="1"/>
        </div>
        <p class="help is-danger"><?php echo $id_err;?></p>
      </div>
      <div class="control">
        <input type="submit" class="button is-danger" name="delete_type" value="EXCLUIR"/>
      </div>
    </form>
  </div>

  <div class="columns">
      <div class="label column">ID</div>
      <div class="label column is-6">Título</div>
      <div class="label column is-4">Imposto (%)</div>
  </div>
  <?php
    if(!empty($type_itens))
      for($i=0; $i < count($type_itens); $i++){
        echo  "<div class='columns'>" .
                "<div class='column'>" . $type_itens[$i]["idtype_item"] . "</div>" .
                "<div class='column is-6'>" . $type_itens[$i]["title"] . "</div>" .
                "<div class='column is-4'>" . $type_itens[$i]["tax"] . "</div>" .
              "</div>";
      }
  ?>
</div>
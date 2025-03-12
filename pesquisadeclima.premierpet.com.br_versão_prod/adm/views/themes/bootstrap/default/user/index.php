<!-- Content -->
<div class="content-wrapper">
<section class="content-header">
<!-- Content -->
<h1 style="color:#0099cc;"><i class="fa fa-user" aria-hidden="true"></i> Usuário</h1>
<br>

<?php 

if(isset($this->singleUser)) { 
	$pagina = "user/update/" . $this->singleUser['id'];
	$botao  = "Atualizar";
} else {
	$pagina = "user/create";
	$botao  = "Cadastrar";
}

?>

<!-- DONUT CHART -->
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Cadastro</h3>
      
      
    </div>
    <div class="box-body">
   
    <!-- Form -->
      <div class="row">
      <form method="post" action="<?php echo URL . $pagina; ?>">
        <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label for="login">Login</label>
              <input type="text" name="login" class="form-control" value="<?php echo $this->singleUser['login']; ?>" required/>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
            <label >Password</label>
            <input type="password" name="password" class="form-control" required/>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <label>Função</label>
            <select name="nivel" class="form-control">
                <option value="2" <?php if($this->singleUser['nivel'] == 2) { ?> selected <? } ?>>Usuários</option>
                  <option value="1" <?php if($this->singleUser['nivel'] == 1) { ?> selected <? } ?>>Gerentes</option>
                  <option value="0" <?php if($this->singleUser['nivel'] == 0) { ?> selected <? } ?>>Administradores</option>
              </select>
          </div>
          <label>&nbsp;</label>
          <div class="col-xs-12 col-md-4 col-lg-3 form-group">
          <input type="submit" class="btn btn-default" value="<?php echo $botao; ?>" />
          </div>
      </form>
      </div>
      <!-- Form -->

  </div>
  <!-- /.box -->

</div>



  <!-- DONUT CHART -->
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Listagem</h3>
      
      
    </div>
    <div class="box-body">
   
    <!-- Table -->
    <table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">
      <thead>
          <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Função</th>
            <th class="text-right">Editar</th>
          </tr>
        </thead>
        <tbody>
      <?php
        if(isset($this->userList)) {
          
          foreach($this->userList as $user) {
            echo '<tr>';
              echo '<td>' . $user['id']     . '</td>';
              echo '<td>' . $user['login']  . '</td>';
              echo '<td>' . Func::getNivel($user['nivel'])  . '</td>';
              echo '<td align="right"><a class="btn btn-default  btn-xs" href="' . URL . 'user/edit/' . $user['id'] . '"><span class="glyphicon glyphicon-pencil text-info"></span> Editar</a> <a class="btn btn-default  btn-xs" href="' . URL . 'user/delete/' . $user['id'] . '"><span class="glyphicon glyphicon-trash text-danger"></span> Deletar</a> </td>';
            echo '</tr>';
          }   
        }
      ?>
      </tbody>
      </table>
      <!-- Table -->

  </div>
  <!-- /.box -->

</div>


<!-- Content -->
</section>
</div>
<!-- Content -->
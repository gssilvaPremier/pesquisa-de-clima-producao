<div class="login-box">
  <div class="login-logo">
    <b>PremieR pet</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Acesso restrito</p>

    <?php if(1==1) { ?>
    <form action="<?php echo URL; ?>login/run" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="inputEmail" name="login" class="form-control" placeholder="Usuário" required autofocus value="<?php echo (!empty($_COOKIE['login'])) ? Cookie::get('login') : ''; ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Senha" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <?php if(COOKIE) { ?>
              <label> <input type="checkbox"> Lembrar minha senha?</label>
              <?php } ?>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Acessar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  <?php } else { ?>
    <h3>Pesquisa de clima encerrada</h3>
  <?php } ?>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->






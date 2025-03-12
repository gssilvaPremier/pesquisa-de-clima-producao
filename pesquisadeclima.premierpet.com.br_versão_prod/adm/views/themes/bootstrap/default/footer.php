<div class="pull-right text-danger"><b>
  <?php if(DB_CONECTION != '') { echo 'CONECTADO À BASE: ' . DB_CONECTION; } ?>
  </b></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo URL . PASTA_API . '/' . API; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo URL . PASTA_API . '/' . API; ?>/dist/js/app.min.js"></script>
<?php
	if(isset($this->js)) {
		foreach($this->js as $js) {
			echo '<script src="'. URL . PASTA_VIEWS . '/themes/' . API . '/' . TEMPLATE . '/'.$js.'.js"></script>';
		}
	}
?>
<script src="<?php echo URL . PASTA_API . '/' . API; ?>/js/funcoes.js"></script>
<script src="<?php echo URL . PASTA_API . '/' . API; ?>/js/jquery.cookie.js"></script>
</body></html>
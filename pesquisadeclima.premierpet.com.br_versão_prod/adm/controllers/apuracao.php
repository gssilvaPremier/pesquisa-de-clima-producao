<?php

class Apuracao extends Controller
{

	function __construct()
	{
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		$role   = Session::get('nivel');
		if ($logged == false || $role != 0) {
			Session::onDestroy();
			header('location: ' . URL . 'login');
			exit;
		}

		$this->view->js = array('apuracao/js/funcoes');
		$this->view->instanceDB = NULL;
	}

	public function Index()
	{
		$this->view->instanceDB = $this->model->instanceDB();
		$this->view->render('apuracao/index');
	}

	public function xhrGetListings()
	{
		$string = '';
		$r = $this->model->xhrGetListings();

		$string .= '<table border="0" cellpadding="15" cellspacing="0" class="table table-striped table-hover">';
		$string .= '<thead><tr><th>Empresa</th><th>Quantidade de votos</th></tr></thead><tbody>';
		foreach ($r as $type) {
			$string .= '<tr><td>' . $type['nome'] . '</td><td>' . $type['votos'] . '</td></tr>';
		}
		$string .= '</tbody></table>';

		$string .= '<div class="accordion box box-success">';

		// Primeira tabela de setores (Setores Premier)
		$r = $this->model->xhrGetListingsSetorPremier();
		$string .= '<h3 class="box-titles" onclick="toggleAccordion(this)">Setores Premier <span class="icon">▼</span></h3>';
		$string .= '<div class="accordion-content box box-success" style="display: none;">';
		$string .= '<table border="0" cellpadding="15" cellspacing="0" class="table table-striped table-hover">';
		$string .= '<thead><tr><th>Localidade</th><th>Setor</th><th>Quantidade de votos</th></tr></thead><tbody>';
		foreach ($r as $type) {
			$string .= '<tr><td>' . $type['localidade'] . '</td><td>' . utf8_encode($type['setor']) . '</td><td>' . $type['qtd_votos'] . '</td></tr>';
		}
		$string .= '</tbody></table></div>';

		// Segunda tabela de setores (Setores Progato)
		$r = $this->model->xhrGetListingsSetorProgato();
		$string .= '<h3 class="box-titles" onclick="toggleAccordion(this)">Setores Progato <span class="icon">▼</span></h3>';
		$string .= '<div class="accordion-content box box-success" style="display: none;">';
		$string .= '<table border="0" cellpadding="15" cellspacing="0" class="table table-striped table-hover">';
		$string .= '<thead><tr><th>Setor</th><th>Quantidade de votos</th></tr></thead><tbody>';
		foreach ($r as $type) {
			$string .= '<tr><td>' . utf8_encode($type['setor']) . '</td><td>' . $type['qtd_votos'] . '</td></tr>';
		}
		$string .= '</tbody></table></div>';

		// Terceira tabela de setores (Setores Grandfood)
		$r = $this->model->xhrGetListingsSetorGrandfood();
		$string .= '<h3 class="box-titles" onclick="toggleAccordion(this)">Setores Grandfood <span class="icon">▼</span></h3>';
		$string .= '<div class="accordion-content box box-success" style="display: none;">';
		$string .= '<table border="0" cellpadding="15" cellspacing="0" class="table table-striped table-hover">';
		$string .= '<thead><tr><th>Setor</th><th>Quantidade de votos</th></tr></thead><tbody>';
		foreach ($r as $type) {
			$string .= '<tr><td>' . utf8_encode($type['setor']) . '</td><td>' . $type['qtd_votos'] . '</td></tr>';
		}
		$string .= '</tbody></table></div>';

		$string .= '</div>';

		$string .= '<script>
				function toggleAccordion(element) {
					const content = element.nextElementSibling;
					const icon = element.querySelector(".icon");
					const allContents = document.querySelectorAll(".accordion-content");
					const allIcons = document.querySelectorAll(".icon");
		
					allContents.forEach(c => { if (c !== content) c.style.display = "none"; });
					allIcons.forEach(i => { if (i !== icon) i.innerHTML = "▼"; });
		
					if (content.style.display === "none") {
						content.style.display = "block";
						icon.innerHTML = "▲";
					} else {
						content.style.display = "none";
						icon.innerHTML = "▼";
					}
				}
			</script>';

		$string .= '<style>
				h3.box-titles {
					cursor: pointer;
					font-size: 18px;
					position: relative;
					background: #ffffff;
					width: 100%;
					display: flex;
					align-items: center;
					justify-content: space-between;
					border: 2px solid #3c8dbc;
					padding: 10px 20px;
					transition: 0.3s;
				}
				.icon {
					font-size: 16px;
					margin-left: 10px;
					color: #3c8dbc;
				}
			</style>';

		echo $string;
	}
}

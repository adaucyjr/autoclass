<?
require_once "class/ControllerMaster.php";
require_once "modulo/sistema/class/LogBO.php";

Class Log extends ControllerMaster
{
	//Métodos
	function listar()
	{
		$this->DataGrid = new DataGrid($this->BO, "log_id");
		$this->DataGrid->set_btInserir("sistema/log/inserir");
		$this->DataGrid->set_field("log_id", "LOG_ID", "", "");
		$this->DataGrid->set_field("usu_id", "USU_ID", "", "");
		$this->DataGrid->set_field("log_data_hora", "LOG_DATA_HORA", "", "");
		$this->DataGrid->set_field("log_ip", "LOG_IP", "", "");
		$this->DataGrid->set_field("log_tela", "LOG_TELA", "", "");
		$this->DataGrid->set_field("log_acao", "LOG_ACAO", "", "");
		$this->DataGrid->set_tool("Exibir", "sistema/log", "glyphicon glyphicon-file", "Exibir");
		if($this->Seguranca->verificaAcesso("excluir", $this->page))
		{
			$this->DataGrid->set_tool("Excluir", "sistema/log", "glyphicon glyphicon-trash", "Excluir", "Excluir");
		}
		$this->lista = $this->DataGrid->show();
		$this->Seguranca->registraLog($this->url, "l");
	}
	
	function inserir()
	{
		$this->Seguranca->validaAcesso("inserir", $this->page);
	}
	
	function exibir()
	{
		if(isset($_GET["id"]) && (int)$_GET["id"])
		{
			$this->VO = $this->BO->exibe((int)$_GET["id"]);
			if(!(int)$this->VO->get_log_id())
			{
				header("Location:".$this->redirect);
				exit;
			}
			$this->Seguranca->registraLog($this->url, "v");
		}
		else
		{
			header("Location:".$this->redirect);
			exit;
		}
	}
	
	function editar()
	{
		$this->Seguranca->validaAcesso("alterar", $this->page);
		$this->exibir();
	}
	
	function salvar()
	{
		$this->VO->set_log_id($_POST["log_id"]);
		$this->VO->set_usu_id($_POST["usu_id"]);
		$this->VO->set_log_data_hora($_POST["log_data_hora"]);
		$this->VO->set_log_ip($_POST["log_ip"]);
		$this->VO->set_log_tela($_POST["log_tela"]);
		$this->VO->set_log_acao($_POST["log_acao"]);
		if((int)$this->VO->get_log_id())
		{
			$this->Seguranca->validaAcesso("alterar", $this->page);
			$this->BO->atualiza($this->VO);
			$this->Seguranca->registraLog($this->url, "a");
			$_SESSION["msg"] = "Sucesso! Registro atualizado com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_log_id());
			exit;
		}
		else
		{
			$this->Seguranca->validaAcesso("inserir", $this->page);
			$this->BO->insere($this->VO);
			$this->Seguranca->registraLog($this->url, "i");
			$this->VO->set_log_id($this->BO->ultimoId());
			$_SESSION["msg"] = "Sucesso! Registro inserido com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_log_id());
			exit;
		}
	}
	
	function excluir()
	{
		$this->Seguranca->validaAcesso("excluir", $this->page);
		$this->BO->deleta((int)$_GET["id"]);
		$this->Seguranca->registraLog($this->url, "e");
		$_SESSION["msg"] = "Sucesso! O registro foi excluído com sucesso.";
		header("Location:".$this->redirect);
		exit;
	}
	
	function onLoad()
	{
		
	}
	
}

$Log = new Log("log", "sistema", "Log");
?>
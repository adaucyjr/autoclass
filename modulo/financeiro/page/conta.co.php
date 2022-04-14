<?
require_once "class/ControllerMaster.php";
require_once "modulo/financeiro/class/ContaBO.php";

Class Conta extends ControllerMaster
{
	//Métodos
	function listar()
	{
		$this->DataGrid = new DataGrid($this->BO, "con_id");
		$this->DataGrid->set_btInserir("financeiro/conta/inserir");
		$this->DataGrid->set_field("con_id", "CON_ID", "", "");
		$this->DataGrid->set_field("con_nome", "CON_NOME", "", "");
		$this->DataGrid->set_field("con_numero", "CON_NUMERO", "", "");
		$this->DataGrid->set_field("con_tipo", "CON_TIPO", "", "");
		$this->DataGrid->set_field("con_saldo", "CON_SALDO", "", "");
		$this->DataGrid->set_tool("Exibir", "financeiro/conta", "glyphicon glyphicon-file", "Exibir");
		if($this->Seguranca->verificaAcesso("excluir", $this->page))
		{
			$this->DataGrid->set_tool("Excluir", "financeiro/conta", "glyphicon glyphicon-trash", "Excluir", "Excluir");
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
			if(!(int)$this->VO->get_con_id())
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
		$this->VO->set_con_id($_POST["con_id"]);
		$this->VO->set_con_nome($_POST["con_nome"]);
		$this->VO->set_con_numero($_POST["con_numero"]);
		$this->VO->set_con_tipo($_POST["con_tipo"]);
		$this->VO->set_con_saldo($_POST["con_saldo"]);
		if((int)$this->VO->get_con_id())
		{
			$this->Seguranca->validaAcesso("alterar", $this->page);
			$this->BO->atualiza($this->VO);
			$this->Seguranca->registraLog($this->url, "a");
			$_SESSION["msg"] = "Sucesso! Registro atualizado com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_con_id());
			exit;
		}
		else
		{
			$this->Seguranca->validaAcesso("inserir", $this->page);
			$this->BO->insere($this->VO);
			$this->Seguranca->registraLog($this->url, "i");
			$this->VO->set_con_id($this->BO->ultimoId());
			$_SESSION["msg"] = "Sucesso! Registro inserido com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_con_id());
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

$Conta = new Conta("conta", "financeiro", "Conta");
?>
<?
require_once "class/ControllerMaster.php";
require_once "modulo/sistema/class/AcessoBO.php";

Class Acesso extends ControllerMaster
{
	//Métodos
	function listar()
	{
		$this->DataGrid = new DataGrid($this->BO, "ace_id");
		$this->DataGrid->set_btInserir("sistema/acesso/inserir");
		$this->DataGrid->set_field("ace_id", "ACE_ID", "", "");
		$this->DataGrid->set_field("usu_grp_id", "USU_GRP_ID", "", "");
		$this->DataGrid->set_field("fer_id", "FER_ID", "", "");
		$this->DataGrid->set_field("ace_visualizar", "ACE_VISUALIZAR", "", "");
		$this->DataGrid->set_field("ace_inserir", "ACE_INSERIR", "", "");
		$this->DataGrid->set_field("ace_alterar", "ACE_ALTERAR", "", "");
		$this->DataGrid->set_field("ace_excluir", "ACE_EXCLUIR", "", "");
		$this->DataGrid->set_tool("Exibir", "sistema/acesso", "glyphicon glyphicon-file", "Exibir");
		if($this->Seguranca->verificaAcesso("excluir", $this->page))
		{
			$this->DataGrid->set_tool("Excluir", "sistema/acesso", "glyphicon glyphicon-trash", "Excluir", "Excluir");
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
			if(!(int)$this->VO->get_ace_id())
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
		$this->VO->set_ace_id($_POST["ace_id"]);
		$this->VO->set_usu_grp_id($_POST["usu_grp_id"]);
		$this->VO->set_fer_id($_POST["fer_id"]);
		$this->VO->set_ace_visualizar($_POST["ace_visualizar"]);
		$this->VO->set_ace_inserir($_POST["ace_inserir"]);
		$this->VO->set_ace_alterar($_POST["ace_alterar"]);
		$this->VO->set_ace_excluir($_POST["ace_excluir"]);
		if((int)$this->VO->get_ace_id())
		{
			$this->Seguranca->validaAcesso("alterar", $this->page);
			$this->BO->atualiza($this->VO);
			$this->Seguranca->registraLog($this->url, "a");
			$_SESSION["msg"] = "Sucesso! Registro atualizado com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_ace_id());
			exit;
		}
		else
		{
			$this->Seguranca->validaAcesso("inserir", $this->page);
			$this->BO->insere($this->VO);
			$this->Seguranca->registraLog($this->url, "i");
			$this->VO->set_ace_id($this->BO->ultimoId());
			$_SESSION["msg"] = "Sucesso! Registro inserido com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_ace_id());
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

$Acesso = new Acesso("acesso", "sistema", "Acesso");
?>
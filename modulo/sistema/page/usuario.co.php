<?
require_once "class/ControllerMaster.php";
require_once "modulo/sistema/class/UsuarioBO.php";

Class Usuario extends ControllerMaster
{
	//Métodos
	function listar()
	{
		$this->DataGrid = new DataGrid($this->BO, "usu_id");
		$this->DataGrid->set_btInserir("sistema/usuario/inserir");
		$this->DataGrid->set_field("usu_id", "USU_ID", "", "");
		$this->DataGrid->set_field("usu_login", "USU_LOGIN", "", "");
		$this->DataGrid->set_field("usu_grp_id", "USU_GRP_ID", "", "");
		$this->DataGrid->set_field("usu_status", "USU_STATUS", "", "");
		$this->DataGrid->set_field("pes_id", "PES_ID", "", "");
		$this->DataGrid->set_tool("Exibir", "sistema/usuario", "glyphicon glyphicon-file", "Exibir");
		if($this->Seguranca->verificaAcesso("excluir", $this->page))
		{
			$this->DataGrid->set_tool("Excluir", "sistema/usuario", "glyphicon glyphicon-trash", "Excluir", "Excluir");
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
			if(!(int)$this->VO->get_usu_id())
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
		$this->VO->set_usu_id($_POST["usu_id"]);
		$this->VO->set_usu_login($_POST["usu_login"]);
		$this->VO->set_usu_senha($_POST["usu_senha"]);
		$this->VO->set_usu_grp_id($_POST["usu_grp_id"]);
		$this->VO->set_usu_status($_POST["usu_status"]);
		$this->VO->set_pes_id($_POST["pes_id"]);
		if((int)$this->VO->get_usu_id())
		{
			$this->Seguranca->validaAcesso("alterar", $this->page);
			$this->BO->atualiza($this->VO);
			$this->Seguranca->registraLog($this->url, "a");
			$_SESSION["msg"] = "Sucesso! Registro atualizado com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_usu_id());
			exit;
		}
		else
		{
			$this->Seguranca->validaAcesso("inserir", $this->page);
			$this->BO->insere($this->VO);
			$this->Seguranca->registraLog($this->url, "i");
			$this->VO->set_usu_id($this->BO->ultimoId());
			$_SESSION["msg"] = "Sucesso! Registro inserido com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_usu_id());
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

$Usuario = new Usuario("usuario", "sistema", "Usuario");
?>
<?
require_once "class/ControllerMaster.php";
require_once "modulo/rh/class/FuncionarioBO.php";

Class Funcionario extends ControllerMaster
{
	//Métodos
	function listar()
	{
		$this->DataGrid = new DataGrid($this->BO, "fun_id");
		$this->DataGrid->set_btInserir("rh/funcionario/inserir");
		$this->DataGrid->set_field("fun_id", "FUN_ID", "", "");
		$this->DataGrid->set_field("pes_id", "PES_ID", "", "");
		$this->DataGrid->set_field("fun_documento", "FUN_DOCUMENTO", "", "");
		$this->DataGrid->set_field("car_id", "CAR_ID", "", "");
		$this->DataGrid->set_field("fun_funcao", "FUN_FUNCAO", "", "");
		$this->DataGrid->set_field("fun_salario", "FUN_SALARIO", "", "");
		$this->DataGrid->set_field("fun_admissao", "FUN_ADMISSAO", "", "");
		$this->DataGrid->set_field("fun_demissao", "FUN_DEMISSAO", "", "");
		$this->DataGrid->set_field("fun_setor", "FUN_SETOR", "", "");
		$this->DataGrid->set_tool("Exibir", "rh/funcionario", "glyphicon glyphicon-file", "Exibir");
		if($this->Seguranca->verificaAcesso("excluir", $this->page))
		{
			$this->DataGrid->set_tool("Excluir", "rh/funcionario", "glyphicon glyphicon-trash", "Excluir", "Excluir");
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
			if(!(int)$this->VO->get_fun_id())
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
		$this->VO->set_fun_id($_POST["fun_id"]);
		$this->VO->set_pes_id($_POST["pes_id"]);
		$this->VO->set_fun_documento($_POST["fun_documento"]);
		$this->VO->set_car_id($_POST["car_id"]);
		$this->VO->set_fun_funcao($_POST["fun_funcao"]);
		$this->VO->set_fun_salario($_POST["fun_salario"]);
		$this->VO->set_fun_admissao($_POST["fun_admissao"]);
		$this->VO->set_fun_demissao($_POST["fun_demissao"]);
		$this->VO->set_fun_setor($_POST["fun_setor"]);
		if((int)$this->VO->get_fun_id())
		{
			$this->Seguranca->validaAcesso("alterar", $this->page);
			$this->BO->atualiza($this->VO);
			$this->Seguranca->registraLog($this->url, "a");
			$_SESSION["msg"] = "Sucesso! Registro atualizado com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_fun_id());
			exit;
		}
		else
		{
			$this->Seguranca->validaAcesso("inserir", $this->page);
			$this->BO->insere($this->VO);
			$this->Seguranca->registraLog($this->url, "i");
			$this->VO->set_fun_id($this->BO->ultimoId());
			$_SESSION["msg"] = "Sucesso! Registro inserido com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_fun_id());
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

$Funcionario = new Funcionario("funcionario", "rh", "Funcionario");
?>
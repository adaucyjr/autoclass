<?
require_once "class/ControllerMaster.php";
require_once "modulo/financeiro/class/MovimentacaoBO.php";

Class Movimentacao extends ControllerMaster
{
	//Métodos
	function listar()
	{
		$this->DataGrid = new DataGrid($this->BO, "mov_id");
		$this->DataGrid->set_btInserir("financeiro/movimentacao/inserir");
		$this->DataGrid->set_field("mov_id", "MOV_ID", "", "");
		$this->DataGrid->set_field("con_id", "CON_ID", "", "");
		$this->DataGrid->set_field("mov_valor", "MOV_VALOR", "", "");
		$this->DataGrid->set_field("mov_tipo", "MOV_TIPO", "", "");
		$this->DataGrid->set_field("mov_descricao", "MOV_DESCRICAO", "", "");
		$this->DataGrid->set_tool("Exibir", "financeiro/movimentacao", "glyphicon glyphicon-file", "Exibir");
		if($this->Seguranca->verificaAcesso("excluir", $this->page))
		{
			$this->DataGrid->set_tool("Excluir", "financeiro/movimentacao", "glyphicon glyphicon-trash", "Excluir", "Excluir");
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
			if(!(int)$this->VO->get_mov_id())
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
		$this->VO->set_mov_id($_POST["mov_id"]);
		$this->VO->set_con_id($_POST["con_id"]);
		$this->VO->set_mov_valor($_POST["mov_valor"]);
		$this->VO->set_mov_tipo($_POST["mov_tipo"]);
		$this->VO->set_mov_descricao($_POST["mov_descricao"]);
		if((int)$this->VO->get_mov_id())
		{
			$this->Seguranca->validaAcesso("alterar", $this->page);
			$this->BO->atualiza($this->VO);
			$this->Seguranca->registraLog($this->url, "a");
			$_SESSION["msg"] = "Sucesso! Registro atualizado com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_mov_id());
			exit;
		}
		else
		{
			$this->Seguranca->validaAcesso("inserir", $this->page);
			$this->BO->insere($this->VO);
			$this->Seguranca->registraLog($this->url, "i");
			$this->VO->set_mov_id($this->BO->ultimoId());
			$_SESSION["msg"] = "Sucesso! Registro inserido com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_mov_id());
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

$Movimentacao = new Movimentacao("movimentacao", "financeiro", "Movimentacao");
?>
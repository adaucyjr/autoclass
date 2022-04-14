<?
require_once "class/ControllerMaster.php";
require_once "modulo/sistema/class/InstituicaoBO.php";

Class Instituicao extends ControllerMaster
{
	//Métodos
	function listar()
	{
		$this->DataGrid = new DataGrid($this->BO, "ins_id");
		$this->DataGrid->set_btInserir("sistema/instituicao/inserir");
		$this->DataGrid->set_field("ins_id", "INS_ID", "", "");
		$this->DataGrid->set_field("ins_cnpj", "INS_CNPJ", "", "");
		$this->DataGrid->set_field("ins_cepj", "INS_CEPJ", "", "");
		$this->DataGrid->set_field("ins_cmpj", "INS_CMPJ", "", "");
		$this->DataGrid->set_field("ins_razao_social", "INS_RAZAO_SOCIAL", "", "");
		$this->DataGrid->set_field("ins_nome_fantasia", "INS_NOME_FANTASIA", "", "");
		$this->DataGrid->set_field("ins_abertura", "INS_ABERTURA", "", "");
		$this->DataGrid->set_field("ins_fechamento", "INS_FECHAMENTO", "", "");
		$this->DataGrid->set_field("ins_tipo", "INS_TIPO", "", "");
		$this->DataGrid->set_field("ins_ramo", "INS_RAMO", "", "");
		$this->DataGrid->set_field("ins_end_logradouro", "INS_END_LOGRADOURO", "", "");
		$this->DataGrid->set_field("ins_end_num", "INS_END_NUM", "", "");
		$this->DataGrid->set_field("ins_end_complemento", "INS_END_COMPLEMENTO", "", "");
		$this->DataGrid->set_field("ins_end_bairro", "INS_END_BAIRRO", "", "");
		$this->DataGrid->set_field("ins_end_cidade", "INS_END_CIDADE", "", "");
		$this->DataGrid->set_field("ins_end_estado", "INS_END_ESTADO", "", "");
		$this->DataGrid->set_field("ins_end_cep", "INS_END_CEP", "", "");
		$this->DataGrid->set_field("ins_telefone1", "INS_TELEFONE1", "", "");
		$this->DataGrid->set_field("ins_telefone2", "INS_TELEFONE2", "", "");
		$this->DataGrid->set_field("ins_email1", "INS_EMAIL1", "", "");
		$this->DataGrid->set_field("ins_email2", "INS_EMAIL2", "", "");
		$this->DataGrid->set_tool("Exibir", "sistema/instituicao", "glyphicon glyphicon-file", "Exibir");
		if($this->Seguranca->verificaAcesso("excluir", $this->page))
		{
			$this->DataGrid->set_tool("Excluir", "sistema/instituicao", "glyphicon glyphicon-trash", "Excluir", "Excluir");
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
			if(!(int)$this->VO->get_ins_id())
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
		$this->VO->set_ins_id($_POST["ins_id"]);
		$this->VO->set_ins_cnpj($_POST["ins_cnpj"]);
		$this->VO->set_ins_cepj($_POST["ins_cepj"]);
		$this->VO->set_ins_cmpj($_POST["ins_cmpj"]);
		$this->VO->set_ins_razao_social($_POST["ins_razao_social"]);
		$this->VO->set_ins_nome_fantasia($_POST["ins_nome_fantasia"]);
		$this->VO->set_ins_abertura($_POST["ins_abertura"]);
		$this->VO->set_ins_fechamento($_POST["ins_fechamento"]);
		$this->VO->set_ins_tipo($_POST["ins_tipo"]);
		$this->VO->set_ins_ramo($_POST["ins_ramo"]);
		$this->VO->set_ins_end_logradouro($_POST["ins_end_logradouro"]);
		$this->VO->set_ins_end_num($_POST["ins_end_num"]);
		$this->VO->set_ins_end_complemento($_POST["ins_end_complemento"]);
		$this->VO->set_ins_end_bairro($_POST["ins_end_bairro"]);
		$this->VO->set_ins_end_cidade($_POST["ins_end_cidade"]);
		$this->VO->set_ins_end_estado($_POST["ins_end_estado"]);
		$this->VO->set_ins_end_cep($_POST["ins_end_cep"]);
		$this->VO->set_ins_telefone1($_POST["ins_telefone1"]);
		$this->VO->set_ins_telefone2($_POST["ins_telefone2"]);
		$this->VO->set_ins_email1($_POST["ins_email1"]);
		$this->VO->set_ins_email2($_POST["ins_email2"]);
		if((int)$this->VO->get_ins_id())
		{
			$this->Seguranca->validaAcesso("alterar", $this->page);
			$this->BO->atualiza($this->VO);
			$this->Seguranca->registraLog($this->url, "a");
			$_SESSION["msg"] = "Sucesso! Registro atualizado com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_ins_id());
			exit;
		}
		else
		{
			$this->Seguranca->validaAcesso("inserir", $this->page);
			$this->BO->insere($this->VO);
			$this->Seguranca->registraLog($this->url, "i");
			$this->VO->set_ins_id($this->BO->ultimoId());
			$_SESSION["msg"] = "Sucesso! Registro inserido com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_ins_id());
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

$Instituicao = new Instituicao("instituicao", "sistema", "Instituicao");
?>
<?
require_once "class/ControllerMaster.php";
require_once "modulo/sistema/class/PessoaBO.php";

Class Pessoa extends ControllerMaster
{
	//Métodos
	function listar()
	{
		$this->DataGrid = new DataGrid($this->BO, "pes_id");
		$this->DataGrid->set_btInserir("sistema/pessoa/inserir");
		$this->DataGrid->set_field("pes_id", "PES_ID", "", "");
		$this->DataGrid->set_field("pes_nome", "PES_NOME", "", "");
		$this->DataGrid->set_field("pes_sobrenome", "PES_SOBRENOME", "", "");
		$this->DataGrid->set_field("pes_cpf", "PES_CPF", "", "");
		$this->DataGrid->set_field("pes_rg", "PES_RG", "", "");
		$this->DataGrid->set_field("pes_rg_orgao", "PES_RG_ORGAO", "", "");
		$this->DataGrid->set_field("pes_rg_estado", "PES_RG_ESTADO", "", "");
		$this->DataGrid->set_field("pes_nascimento", "PES_NASCIMENTO", "", "");
		$this->DataGrid->set_field("pes_obito", "PES_OBITO", "", "");
		$this->DataGrid->set_field("pes_sexo", "PES_SEXO", "", "");
		$this->DataGrid->set_field("pes_escolariadade", "PES_ESCOLARIADADE", "", "");
		$this->DataGrid->set_field("pes_profissao", "PES_PROFISSAO", "", "");
		$this->DataGrid->set_field("pes_naturalidade", "PES_NATURALIDADE", "", "");
		$this->DataGrid->set_field("pes_nacionalidade", "PES_NACIONALIDADE", "", "");
		$this->DataGrid->set_field("pes_res_logradouro", "PES_RES_LOGRADOURO", "", "");
		$this->DataGrid->set_field("pes_res_numero", "PES_RES_NUMERO", "", "");
		$this->DataGrid->set_field("pes_res_complemento", "PES_RES_COMPLEMENTO", "", "");
		$this->DataGrid->set_field("pes_res_bairro", "PES_RES_BAIRRO", "", "");
		$this->DataGrid->set_field("pes_res_cidade", "PES_RES_CIDADE", "", "");
		$this->DataGrid->set_field("pes_res_estado", "PES_RES_ESTADO", "", "");
		$this->DataGrid->set_field("pes_res_cep", "PES_RES_CEP", "", "");
		$this->DataGrid->set_field("pes_tra_logradouro", "PES_TRA_LOGRADOURO", "", "");
		$this->DataGrid->set_field("pes_tra_numero", "PES_TRA_NUMERO", "", "");
		$this->DataGrid->set_field("pes_tra_complemento", "PES_TRA_COMPLEMENTO", "", "");
		$this->DataGrid->set_field("pes_tra_bairro", "PES_TRA_BAIRRO", "", "");
		$this->DataGrid->set_field("pes_tra_cidade", "PES_TRA_CIDADE", "", "");
		$this->DataGrid->set_field("pes_tra_estado", "PES_TRA_ESTADO", "", "");
		$this->DataGrid->set_field("pes_tra_cep", "PES_TRA_CEP", "", "");
		$this->DataGrid->set_field("pes_telefone1", "PES_TELEFONE1", "", "");
		$this->DataGrid->set_field("pes_telefone2", "PES_TELEFONE2", "", "");
		$this->DataGrid->set_field("pes_email1", "PES_EMAIL1", "", "");
		$this->DataGrid->set_field("pes_email2", "PES_EMAIL2", "", "");
		$this->DataGrid->set_tool("Exibir", "sistema/pessoa", "glyphicon glyphicon-file", "Exibir");
		if($this->Seguranca->verificaAcesso("excluir", $this->page))
		{
			$this->DataGrid->set_tool("Excluir", "sistema/pessoa", "glyphicon glyphicon-trash", "Excluir", "Excluir");
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
			if(!(int)$this->VO->get_pes_id())
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
		$this->VO->set_pes_id($_POST["pes_id"]);
		$this->VO->set_pes_nome($_POST["pes_nome"]);
		$this->VO->set_pes_sobrenome($_POST["pes_sobrenome"]);
		$this->VO->set_pes_cpf($_POST["pes_cpf"]);
		$this->VO->set_pes_rg($_POST["pes_rg"]);
		$this->VO->set_pes_rg_orgao($_POST["pes_rg_orgao"]);
		$this->VO->set_pes_rg_estado($_POST["pes_rg_estado"]);
		$this->VO->set_pes_nascimento($_POST["pes_nascimento"]);
		$this->VO->set_pes_obito($_POST["pes_obito"]);
		$this->VO->set_pes_sexo($_POST["pes_sexo"]);
		$this->VO->set_pes_escolariadade($_POST["pes_escolariadade"]);
		$this->VO->set_pes_profissao($_POST["pes_profissao"]);
		$this->VO->set_pes_naturalidade($_POST["pes_naturalidade"]);
		$this->VO->set_pes_nacionalidade($_POST["pes_nacionalidade"]);
		$this->VO->set_pes_res_logradouro($_POST["pes_res_logradouro"]);
		$this->VO->set_pes_res_numero($_POST["pes_res_numero"]);
		$this->VO->set_pes_res_complemento($_POST["pes_res_complemento"]);
		$this->VO->set_pes_res_bairro($_POST["pes_res_bairro"]);
		$this->VO->set_pes_res_cidade($_POST["pes_res_cidade"]);
		$this->VO->set_pes_res_estado($_POST["pes_res_estado"]);
		$this->VO->set_pes_res_cep($_POST["pes_res_cep"]);
		$this->VO->set_pes_tra_logradouro($_POST["pes_tra_logradouro"]);
		$this->VO->set_pes_tra_numero($_POST["pes_tra_numero"]);
		$this->VO->set_pes_tra_complemento($_POST["pes_tra_complemento"]);
		$this->VO->set_pes_tra_bairro($_POST["pes_tra_bairro"]);
		$this->VO->set_pes_tra_cidade($_POST["pes_tra_cidade"]);
		$this->VO->set_pes_tra_estado($_POST["pes_tra_estado"]);
		$this->VO->set_pes_tra_cep($_POST["pes_tra_cep"]);
		$this->VO->set_pes_telefone1($_POST["pes_telefone1"]);
		$this->VO->set_pes_telefone2($_POST["pes_telefone2"]);
		$this->VO->set_pes_email1($_POST["pes_email1"]);
		$this->VO->set_pes_email2($_POST["pes_email2"]);
		if((int)$this->VO->get_pes_id())
		{
			$this->Seguranca->validaAcesso("alterar", $this->page);
			$this->BO->atualiza($this->VO);
			$this->Seguranca->registraLog($this->url, "a");
			$_SESSION["msg"] = "Sucesso! Registro atualizado com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_pes_id());
			exit;
		}
		else
		{
			$this->Seguranca->validaAcesso("inserir", $this->page);
			$this->BO->insere($this->VO);
			$this->Seguranca->registraLog($this->url, "i");
			$this->VO->set_pes_id($this->BO->ultimoId());
			$_SESSION["msg"] = "Sucesso! Registro inserido com sucesso.";
			header("Location:".$this->redirect."/editar/".$this->VO->get_pes_id());
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

$Pessoa = new Pessoa("pessoa", "sistema", "Pessoa");
?>
<?
require_once "PessoaDO.php";
require_once "PessoaVO.php";
require_once "class/Util.php";

Class PessoaBO
{
	//Atributos
	private $PessoaDO;
	private $Util;

	//Construtor
	function PessoaBO()
	{
		$this->PessoaDO = new PessoaDO();
		$this->Util = new Util();
	}

	//Métodos
	function lista($fields, $where="", $order="", $by="", $pg=1, $regPg=15)
	{
		$where = $where?"%".$where."%":"";
		$by = $by?"DESC":"ASC";
		$pg = $pg?$pg:1;
		$limit1 = ($pg - 1) * $regPg;
		$limit2 = $regPg;
		$result = $this->PessoaDO->lista($fields, $where, $order, $by, $limit1, $limit2);
		while($row = $result[0]->fetch_assoc())
		{
			for($i=0;$i<count($fields);$i++)
			{
				switch ($fields[$i])
				{
					case "nome_campo":
						$item[$fields[$i]] = "novo valor";
						break;
						
					default:
						$item[$fields[$i]] = $row[$fields[$i]];
						break;
				}
				if(!isset($row[$fields[$i]]))
				{
					$item[$fields[$i]] = "-";
				}
			}
			$lista[0][] = $item;
		}
		$row = $result[1]->fetch_assoc();
		$lista[1] = $row["rows"];
		return $lista;
	}

	function exibe($id)
	{
		$result = $this->PessoaDO->exibe($id);
		$row = $result->fetch_assoc();
		$PessoaVO = new PessoaVO();
		$PessoaVO->set_pes_id($row["pes_id"]);
		$PessoaVO->set_pes_nome($row["pes_nome"]);
		$PessoaVO->set_pes_sobrenome($row["pes_sobrenome"]);
		$PessoaVO->set_pes_cpf($row["pes_cpf"]);
		$PessoaVO->set_pes_rg($row["pes_rg"]);
		$PessoaVO->set_pes_rg_orgao($row["pes_rg_orgao"]);
		$PessoaVO->set_pes_rg_estado($row["pes_rg_estado"]);
		$PessoaVO->set_pes_nascimento($row["pes_nascimento"]);
		$PessoaVO->set_pes_obito($row["pes_obito"]);
		$PessoaVO->set_pes_sexo($row["pes_sexo"]);
		$PessoaVO->set_pes_escolariadade($row["pes_escolariadade"]);
		$PessoaVO->set_pes_profissao($row["pes_profissao"]);
		$PessoaVO->set_pes_naturalidade($row["pes_naturalidade"]);
		$PessoaVO->set_pes_nacionalidade($row["pes_nacionalidade"]);
		$PessoaVO->set_pes_res_logradouro($row["pes_res_logradouro"]);
		$PessoaVO->set_pes_res_numero($row["pes_res_numero"]);
		$PessoaVO->set_pes_res_complemento($row["pes_res_complemento"]);
		$PessoaVO->set_pes_res_bairro($row["pes_res_bairro"]);
		$PessoaVO->set_pes_res_cidade($row["pes_res_cidade"]);
		$PessoaVO->set_pes_res_estado($row["pes_res_estado"]);
		$PessoaVO->set_pes_res_cep($row["pes_res_cep"]);
		$PessoaVO->set_pes_tra_logradouro($row["pes_tra_logradouro"]);
		$PessoaVO->set_pes_tra_numero($row["pes_tra_numero"]);
		$PessoaVO->set_pes_tra_complemento($row["pes_tra_complemento"]);
		$PessoaVO->set_pes_tra_bairro($row["pes_tra_bairro"]);
		$PessoaVO->set_pes_tra_cidade($row["pes_tra_cidade"]);
		$PessoaVO->set_pes_tra_estado($row["pes_tra_estado"]);
		$PessoaVO->set_pes_tra_cep($row["pes_tra_cep"]);
		$PessoaVO->set_pes_telefone1($row["pes_telefone1"]);
		$PessoaVO->set_pes_telefone2($row["pes_telefone2"]);
		$PessoaVO->set_pes_email1($row["pes_email1"]);
		$PessoaVO->set_pes_email2($row["pes_email2"]);
		return $PessoaVO;
	}

	function insere($VO)
	{
		$result = $this->PessoaDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->PessoaDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->PessoaDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->PessoaDO->ultimoId();
		$row = $result->fetch_assoc();
		return $row["max_id"];
	}

	function valida($VO)
	{
		$erro = "";
		return $erro;
	}
}
?>
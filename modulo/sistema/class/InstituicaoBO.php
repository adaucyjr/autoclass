<?
require_once "InstituicaoDO.php";
require_once "InstituicaoVO.php";
require_once "class/Util.php";

Class InstituicaoBO
{
	//Atributos
	private $InstituicaoDO;
	private $Util;

	//Construtor
	function InstituicaoBO()
	{
		$this->InstituicaoDO = new InstituicaoDO();
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
		$result = $this->InstituicaoDO->lista($fields, $where, $order, $by, $limit1, $limit2);
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
		$result = $this->InstituicaoDO->exibe($id);
		$row = $result->fetch_assoc();
		$InstituicaoVO = new InstituicaoVO();
		$InstituicaoVO->set_ins_id($row["ins_id"]);
		$InstituicaoVO->set_ins_cnpj($row["ins_cnpj"]);
		$InstituicaoVO->set_ins_cepj($row["ins_cepj"]);
		$InstituicaoVO->set_ins_cmpj($row["ins_cmpj"]);
		$InstituicaoVO->set_ins_razao_social($row["ins_razao_social"]);
		$InstituicaoVO->set_ins_nome_fantasia($row["ins_nome_fantasia"]);
		$InstituicaoVO->set_ins_abertura($row["ins_abertura"]);
		$InstituicaoVO->set_ins_fechamento($row["ins_fechamento"]);
		$InstituicaoVO->set_ins_tipo($row["ins_tipo"]);
		$InstituicaoVO->set_ins_ramo($row["ins_ramo"]);
		$InstituicaoVO->set_ins_end_logradouro($row["ins_end_logradouro"]);
		$InstituicaoVO->set_ins_end_num($row["ins_end_num"]);
		$InstituicaoVO->set_ins_end_complemento($row["ins_end_complemento"]);
		$InstituicaoVO->set_ins_end_bairro($row["ins_end_bairro"]);
		$InstituicaoVO->set_ins_end_cidade($row["ins_end_cidade"]);
		$InstituicaoVO->set_ins_end_estado($row["ins_end_estado"]);
		$InstituicaoVO->set_ins_end_cep($row["ins_end_cep"]);
		$InstituicaoVO->set_ins_telefone1($row["ins_telefone1"]);
		$InstituicaoVO->set_ins_telefone2($row["ins_telefone2"]);
		$InstituicaoVO->set_ins_email1($row["ins_email1"]);
		$InstituicaoVO->set_ins_email2($row["ins_email2"]);
		return $InstituicaoVO;
	}

	function insere($VO)
	{
		$result = $this->InstituicaoDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->InstituicaoDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->InstituicaoDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->InstituicaoDO->ultimoId();
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
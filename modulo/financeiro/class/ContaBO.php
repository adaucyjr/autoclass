<?
require_once "ContaDO.php";
require_once "ContaVO.php";
require_once "class/Util.php";

Class ContaBO
{
	//Atributos
	private $ContaDO;
	private $Util;

	//Construtor
	function ContaBO()
	{
		$this->ContaDO = new ContaDO();
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
		$result = $this->ContaDO->lista($fields, $where, $order, $by, $limit1, $limit2);
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
		$result = $this->ContaDO->exibe($id);
		$row = $result->fetch_assoc();
		$ContaVO = new ContaVO();
		$ContaVO->set_con_id($row["con_id"]);
		$ContaVO->set_con_nome($row["con_nome"]);
		$ContaVO->set_con_numero($row["con_numero"]);
		$ContaVO->set_con_tipo($row["con_tipo"]);
		$ContaVO->set_con_saldo($row["con_saldo"]);
		return $ContaVO;
	}

	function insere($VO)
	{
		$result = $this->ContaDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->ContaDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->ContaDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->ContaDO->ultimoId();
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
<?
require_once "FerramentaDO.php";
require_once "FerramentaVO.php";
require_once "class/Util.php";

Class FerramentaBO
{
	//Atributos
	private $FerramentaDO;
	private $Util;

	//Construtor
	function FerramentaBO()
	{
		$this->FerramentaDO = new FerramentaDO();
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
		$result = $this->FerramentaDO->lista($fields, $where, $order, $by, $limit1, $limit2);
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
		$result = $this->FerramentaDO->exibe($id);
		$row = $result->fetch_assoc();
		$FerramentaVO = new FerramentaVO();
		$FerramentaVO->set_fer_id($row["fer_id"]);
		$FerramentaVO->set_fer_nome($row["fer_nome"]);
		$FerramentaVO->set_fer_page($row["fer_page"]);
		$FerramentaVO->set_mod_id($row["mod_id"]);
		return $FerramentaVO;
	}

	function insere($VO)
	{
		$result = $this->FerramentaDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->FerramentaDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->FerramentaDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->FerramentaDO->ultimoId();
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
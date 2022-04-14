<?
require_once "ModuloDO.php";
require_once "ModuloVO.php";
require_once "class/Util.php";

Class ModuloBO
{
	//Atributos
	private $ModuloDO;
	private $Util;

	//Construtor
	function ModuloBO()
	{
		$this->ModuloDO = new ModuloDO();
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
		$result = $this->ModuloDO->lista($fields, $where, $order, $by, $limit1, $limit2);
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
		$result = $this->ModuloDO->exibe($id);
		$row = $result->fetch_assoc();
		$ModuloVO = new ModuloVO();
		$ModuloVO->set_mod_id($row["mod_id"]);
		$ModuloVO->set_mod_nome($row["mod_nome"]);
		$ModuloVO->set_mod_pasta($row["mod_pasta"]);
		return $ModuloVO;
	}

	function insere($VO)
	{
		$result = $this->ModuloDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->ModuloDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->ModuloDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->ModuloDO->ultimoId();
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
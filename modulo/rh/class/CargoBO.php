<?
require_once "CargoDO.php";
require_once "CargoVO.php";
require_once "class/Util.php";

Class CargoBO
{
	//Atributos
	private $CargoDO;
	private $Util;

	//Construtor
	function CargoBO()
	{
		$this->CargoDO = new CargoDO();
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
		$result = $this->CargoDO->lista($fields, $where, $order, $by, $limit1, $limit2);
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
		$result = $this->CargoDO->exibe($id);
		$row = $result->fetch_assoc();
		$CargoVO = new CargoVO();
		$CargoVO->set_car_id($row["car_id"]);
		$CargoVO->set_car_nome($row["car_nome"]);
		$CargoVO->set_car_salario($row["car_salario"]);
		return $CargoVO;
	}

	function insere($VO)
	{
		$result = $this->CargoDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->CargoDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->CargoDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->CargoDO->ultimoId();
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
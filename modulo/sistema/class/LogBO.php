<?
require_once "LogDO.php";
require_once "LogVO.php";
require_once "class/Util.php";

Class LogBO
{
	//Atributos
	private $LogDO;
	private $Util;

	//Construtor
	function LogBO()
	{
		$this->LogDO = new LogDO();
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
		$result = $this->LogDO->lista($fields, $where, $order, $by, $limit1, $limit2);
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
		$result = $this->LogDO->exibe($id);
		$row = $result->fetch_assoc();
		$LogVO = new LogVO();
		$LogVO->set_log_id($row["log_id"]);
		$LogVO->set_usu_id($row["usu_id"]);
		$LogVO->set_log_data_hora($row["log_data_hora"]);
		$LogVO->set_log_ip($row["log_ip"]);
		$LogVO->set_log_tela($row["log_tela"]);
		$LogVO->set_log_acao($row["log_acao"]);
		return $LogVO;
	}

	function insere($VO)
	{
		$result = $this->LogDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->LogDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->LogDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->LogDO->ultimoId();
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
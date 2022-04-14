<?
require_once "FuncionarioDO.php";
require_once "FuncionarioVO.php";
require_once "class/Util.php";

Class FuncionarioBO
{
	//Atributos
	private $FuncionarioDO;
	private $Util;

	//Construtor
	function FuncionarioBO()
	{
		$this->FuncionarioDO = new FuncionarioDO();
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
		$result = $this->FuncionarioDO->lista($fields, $where, $order, $by, $limit1, $limit2);
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
		$result = $this->FuncionarioDO->exibe($id);
		$row = $result->fetch_assoc();
		$FuncionarioVO = new FuncionarioVO();
		$FuncionarioVO->set_fun_id($row["fun_id"]);
		$FuncionarioVO->set_pes_id($row["pes_id"]);
		$FuncionarioVO->set_fun_documento($row["fun_documento"]);
		$FuncionarioVO->set_car_id($row["car_id"]);
		$FuncionarioVO->set_fun_funcao($row["fun_funcao"]);
		$FuncionarioVO->set_fun_salario($row["fun_salario"]);
		$FuncionarioVO->set_fun_admissao($row["fun_admissao"]);
		$FuncionarioVO->set_fun_demissao($row["fun_demissao"]);
		$FuncionarioVO->set_fun_setor($row["fun_setor"]);
		return $FuncionarioVO;
	}

	function insere($VO)
	{
		$result = $this->FuncionarioDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->FuncionarioDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->FuncionarioDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->FuncionarioDO->ultimoId();
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
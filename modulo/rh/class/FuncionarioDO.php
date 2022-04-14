<?
require_once "class/DataAdapter.php";

Class FuncionarioDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function FuncionarioDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM rh_funcionario NATURAL JOIN sistema_pessoa NATURAL JOIN rh_cargo ";
		if($where != "")
		{
			$query .= "WHERE ".$fields[0]." LIKE ? ";
			for($i=1;$i<count($fields);$i++)
			{
				$query .= "OR ".$fields[$i]." LIKE ? ";
			}
			$param[] = &$where;
			for($i=1;$i<count($fields);$i++)
			{
				$param[] = &$where;
			}
			for($i=0;$i<count($fields);$i++)
			{
				$type .= "s";
			}
		}
		if($order != "")
		{
			$query .= "ORDER BY ".$order." ".$by." ";
		}
		else
		{
			$query .= "ORDER BY fun_id DESC ";
		}
		if(is_int($limit1) && is_int($limit2))
		{
			$query .= "LIMIT ".$limit1.", ".$limit2;
		}
		$lista = $this->DataAdapter->execute($query,$type,$param,1);
		return $lista;
	}

	function exibe($id)
	{
		$query = "SELECT * FROM rh_funcionario WHERE fun_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO rh_funcionario VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?)";
		$pes_id = (bool)$VO->get_pes_id()?$VO->get_pes_id():NULL;
		$fun_documento = $VO->get_fun_documento();
		$car_id = (bool)$VO->get_car_id()?$VO->get_car_id():NULL;
		$fun_funcao = $VO->get_fun_funcao();
		$fun_salario = $VO->get_fun_salario();
		$fun_admissao = $VO->get_fun_admissao();
		$fun_demissao = $VO->get_fun_demissao();
		$fun_setor = (bool)$VO->get_fun_setor()?$VO->get_fun_setor():NULL;
		$param = array(&$pes_id, &$fun_documento, &$car_id, &$fun_funcao, &$fun_salario, &$fun_admissao, &$fun_demissao, &$fun_setor);
		$result = $this->DataAdapter->execute($query,"ssssssss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE rh_funcionario SET pes_id = ?, fun_documento = ?, car_id = ?, fun_funcao = ?, fun_salario = ?, fun_admissao = ?, fun_demissao = ?, fun_setor = ? WHERE fun_id = ?";
		$fun_id = $VO->get_fun_id();
		$pes_id = (bool)$VO->get_pes_id()?$VO->get_pes_id():NULL;
		$fun_documento = $VO->get_fun_documento();
		$car_id = (bool)$VO->get_car_id()?$VO->get_car_id():NULL;
		$fun_funcao = $VO->get_fun_funcao();
		$fun_salario = $VO->get_fun_salario();
		$fun_admissao = $VO->get_fun_admissao();
		$fun_demissao = $VO->get_fun_demissao();
		$fun_setor = (bool)$VO->get_fun_setor()?$VO->get_fun_setor():NULL;
		$param = array(&$pes_id, &$fun_documento, &$car_id, &$fun_funcao, &$fun_salario, &$fun_admissao, &$fun_demissao, &$fun_setor, &$fun_id);
		$result = $this->DataAdapter->execute($query,"ssssssssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM rh_funcionario WHERE fun_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(fun_id) as max_id FROM rh_funcionario";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>
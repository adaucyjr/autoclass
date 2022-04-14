<?
require_once "class/DataAdapter.php";

Class CargoDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function CargoDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM rh_cargo ";
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
			$query .= "ORDER BY car_id DESC ";
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
		$query = "SELECT * FROM rh_cargo WHERE car_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO rh_cargo VALUES ('', ?, ?)";
		$car_nome = $VO->get_car_nome();
		$car_salario = $VO->get_car_salario();
		$param = array(&$car_nome, &$car_salario);
		$result = $this->DataAdapter->execute($query,"ss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE rh_cargo SET car_nome = ?, car_salario = ? WHERE car_id = ?";
		$car_id = $VO->get_car_id();
		$car_nome = $VO->get_car_nome();
		$car_salario = $VO->get_car_salario();
		$param = array(&$car_nome, &$car_salario, &$car_id);
		$result = $this->DataAdapter->execute($query,"ssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM rh_cargo WHERE car_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(car_id) as max_id FROM rh_cargo";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>
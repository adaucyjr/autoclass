<?
require_once "class/DataAdapter.php";

Class ContaDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function ContaDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM financeiro_conta ";
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
			$query .= "ORDER BY con_id DESC ";
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
		$query = "SELECT * FROM financeiro_conta WHERE con_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO financeiro_conta VALUES ('', ?, ?, ?, ?)";
		$con_nome = $VO->get_con_nome();
		$con_numero = $VO->get_con_numero();
		$con_tipo = $VO->get_con_tipo();
		$con_saldo = $VO->get_con_saldo();
		$param = array(&$con_nome, &$con_numero, &$con_tipo, &$con_saldo);
		$result = $this->DataAdapter->execute($query,"ssss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE financeiro_conta SET con_nome = ?, con_numero = ?, con_tipo = ?, con_saldo = ? WHERE con_id = ?";
		$con_id = $VO->get_con_id();
		$con_nome = $VO->get_con_nome();
		$con_numero = $VO->get_con_numero();
		$con_tipo = $VO->get_con_tipo();
		$con_saldo = $VO->get_con_saldo();
		$param = array(&$con_nome, &$con_numero, &$con_tipo, &$con_saldo, &$con_id);
		$result = $this->DataAdapter->execute($query,"ssssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM financeiro_conta WHERE con_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(con_id) as max_id FROM financeiro_conta";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>
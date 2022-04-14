<?
require_once "class/DataAdapter.php";

Class LogDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function LogDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM sistema_log NATURAL JOIN sistema_usuario ";
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
			$query .= "ORDER BY log_id DESC ";
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
		$query = "SELECT * FROM sistema_log WHERE log_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO sistema_log VALUES ('', ?, ?, ?, ?, ?)";
		$usu_id = (bool)$VO->get_usu_id()?$VO->get_usu_id():NULL;
		$log_data_hora = $VO->get_log_data_hora();
		$log_ip = $VO->get_log_ip();
		$log_tela = $VO->get_log_tela();
		$log_acao = $VO->get_log_acao();
		$param = array(&$usu_id, &$log_data_hora, &$log_ip, &$log_tela, &$log_acao);
		$result = $this->DataAdapter->execute($query,"sssss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE sistema_log SET usu_id = ?, log_data_hora = ?, log_ip = ?, log_tela = ?, log_acao = ? WHERE log_id = ?";
		$log_id = $VO->get_log_id();
		$usu_id = (bool)$VO->get_usu_id()?$VO->get_usu_id():NULL;
		$log_data_hora = $VO->get_log_data_hora();
		$log_ip = $VO->get_log_ip();
		$log_tela = $VO->get_log_tela();
		$log_acao = $VO->get_log_acao();
		$param = array(&$usu_id, &$log_data_hora, &$log_ip, &$log_tela, &$log_acao, &$log_id);
		$result = $this->DataAdapter->execute($query,"sssssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM sistema_log WHERE log_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(log_id) as max_id FROM sistema_log";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>
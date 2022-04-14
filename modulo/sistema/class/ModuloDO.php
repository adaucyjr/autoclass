<?
require_once "class/DataAdapter.php";

Class ModuloDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function ModuloDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM sistema_modulo ";
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
			$query .= "ORDER BY mod_id DESC ";
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
		$query = "SELECT * FROM sistema_modulo WHERE mod_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO sistema_modulo VALUES ('', ?, ?)";
		$mod_nome = $VO->get_mod_nome();
		$mod_pasta = $VO->get_mod_pasta();
		$param = array(&$mod_nome, &$mod_pasta);
		$result = $this->DataAdapter->execute($query,"ss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE sistema_modulo SET mod_nome = ?, mod_pasta = ? WHERE mod_id = ?";
		$mod_id = $VO->get_mod_id();
		$mod_nome = $VO->get_mod_nome();
		$mod_pasta = $VO->get_mod_pasta();
		$param = array(&$mod_nome, &$mod_pasta, &$mod_id);
		$result = $this->DataAdapter->execute($query,"ssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM sistema_modulo WHERE mod_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(mod_id) as max_id FROM sistema_modulo";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>
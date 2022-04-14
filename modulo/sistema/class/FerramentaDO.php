<?
require_once "class/DataAdapter.php";

Class FerramentaDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function FerramentaDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM sistema_ferramenta NATURAL JOIN sistema_modulo ";
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
			$query .= "ORDER BY fer_id DESC ";
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
		$query = "SELECT * FROM sistema_ferramenta WHERE fer_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO sistema_ferramenta VALUES ('', ?, ?, ?)";
		$fer_nome = $VO->get_fer_nome();
		$fer_page = $VO->get_fer_page();
		$mod_id = (bool)$VO->get_mod_id()?$VO->get_mod_id():NULL;
		$param = array(&$fer_nome, &$fer_page, &$mod_id);
		$result = $this->DataAdapter->execute($query,"sss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE sistema_ferramenta SET fer_nome = ?, fer_page = ?, mod_id = ? WHERE fer_id = ?";
		$fer_id = $VO->get_fer_id();
		$fer_nome = $VO->get_fer_nome();
		$fer_page = $VO->get_fer_page();
		$mod_id = (bool)$VO->get_mod_id()?$VO->get_mod_id():NULL;
		$param = array(&$fer_nome, &$fer_page, &$mod_id, &$fer_id);
		$result = $this->DataAdapter->execute($query,"sssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM sistema_ferramenta WHERE fer_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(fer_id) as max_id FROM sistema_ferramenta";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>
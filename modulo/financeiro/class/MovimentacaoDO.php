<?
require_once "class/DataAdapter.php";

Class MovimentacaoDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function MovimentacaoDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM financeiro_movimentacao NATURAL JOIN financeiro_conta ";
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
			$query .= "ORDER BY mov_id DESC ";
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
		$query = "SELECT * FROM financeiro_movimentacao WHERE mov_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO financeiro_movimentacao VALUES ('', ?, ?, ?, ?)";
		$con_id = (bool)$VO->get_con_id()?$VO->get_con_id():NULL;
		$mov_valor = $VO->get_mov_valor();
		$mov_tipo = $VO->get_mov_tipo();
		$mov_descricao = $VO->get_mov_descricao();
		$param = array(&$con_id, &$mov_valor, &$mov_tipo, &$mov_descricao);
		$result = $this->DataAdapter->execute($query,"ssss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE financeiro_movimentacao SET con_id = ?, mov_valor = ?, mov_tipo = ?, mov_descricao = ? WHERE mov_id = ?";
		$mov_id = $VO->get_mov_id();
		$con_id = (bool)$VO->get_con_id()?$VO->get_con_id():NULL;
		$mov_valor = $VO->get_mov_valor();
		$mov_tipo = $VO->get_mov_tipo();
		$mov_descricao = $VO->get_mov_descricao();
		$param = array(&$con_id, &$mov_valor, &$mov_tipo, &$mov_descricao, &$mov_id);
		$result = $this->DataAdapter->execute($query,"ssssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM financeiro_movimentacao WHERE mov_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(mov_id) as max_id FROM financeiro_movimentacao";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>
<?
require_once "class/DataAdapter.php";

Class UsuarioGrupoDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function UsuarioGrupoDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM sistema_usuario_grupo ";
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
			$query .= "ORDER BY usu_grp_id DESC ";
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
		$query = "SELECT * FROM sistema_usuario_grupo WHERE usu_grp_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO sistema_usuario_grupo VALUES ('', ?)";
		$usu_grp_nome = $VO->get_usu_grp_nome();
		$param = array(&$usu_grp_nome);
		$result = $this->DataAdapter->execute($query,"s",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE sistema_usuario_grupo SET usu_grp_nome = ? WHERE usu_grp_id = ?";
		$usu_grp_id = $VO->get_usu_grp_id();
		$usu_grp_nome = $VO->get_usu_grp_nome();
		$param = array(&$usu_grp_nome, &$usu_grp_id);
		$result = $this->DataAdapter->execute($query,"si",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM sistema_usuario_grupo WHERE usu_grp_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(usu_grp_id) as max_id FROM sistema_usuario_grupo";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>
<?
require_once "class/DataAdapter.php";

Class UsuarioDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function UsuarioDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM sistema_usuario NATURAL JOIN sistema_usuario_grupo LEFT JOIN sistema_pessoa ON sistema_usuario.pes_id = sistema_pessoa.pes_id ";
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
			$query .= "ORDER BY usu_id DESC ";
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
		$query = "SELECT * FROM sistema_usuario WHERE usu_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO sistema_usuario VALUES ('', ?, ?, ?, ?, ?)";
		$usu_login = $VO->get_usu_login();
		$usu_senha = $VO->get_usu_senha();
		$usu_grp_id = (bool)$VO->get_usu_grp_id()?$VO->get_usu_grp_id():NULL;
		$usu_status = (bool)$VO->get_usu_status();
		$pes_id = (bool)$VO->get_pes_id()?$VO->get_pes_id():NULL;
		$param = array(&$usu_login, &$usu_senha, &$usu_grp_id, &$usu_status, &$pes_id);
		$result = $this->DataAdapter->execute($query,"sssss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE sistema_usuario SET usu_login = ?, usu_senha = ?, usu_grp_id = ?, usu_status = ?, pes_id = ? WHERE usu_id = ?";
		$usu_id = $VO->get_usu_id();
		$usu_login = $VO->get_usu_login();
		$usu_senha = $VO->get_usu_senha();
		$usu_grp_id = (bool)$VO->get_usu_grp_id()?$VO->get_usu_grp_id():NULL;
		$usu_status = (bool)$VO->get_usu_status();
		$pes_id = (bool)$VO->get_pes_id()?$VO->get_pes_id():NULL;
		$param = array(&$usu_login, &$usu_senha, &$usu_grp_id, &$usu_status, &$pes_id, &$usu_id);
		$result = $this->DataAdapter->execute($query,"sssssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM sistema_usuario WHERE usu_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(usu_id) as max_id FROM sistema_usuario";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>
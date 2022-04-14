<?
require_once "class/DataAdapter.php";

Class AcessoDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function AcessoDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM sistema_acesso NATURAL JOIN sistema_usuario_grupo NATURAL JOIN sistema_ferramenta ";
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
			$query .= "ORDER BY ace_id DESC ";
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
		$query = "SELECT * FROM sistema_acesso WHERE ace_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO sistema_acesso VALUES ('', ?, ?, ?, ?, ?, ?)";
		$usu_grp_id = (bool)$VO->get_usu_grp_id()?$VO->get_usu_grp_id():NULL;
		$fer_id = (bool)$VO->get_fer_id()?$VO->get_fer_id():NULL;
		$ace_visualizar = (bool)$VO->get_ace_visualizar();
		$ace_inserir = (bool)$VO->get_ace_inserir();
		$ace_alterar = (bool)$VO->get_ace_alterar();
		$ace_excluir = (bool)$VO->get_ace_excluir();
		$param = array(&$usu_grp_id, &$fer_id, &$ace_visualizar, &$ace_inserir, &$ace_alterar, &$ace_excluir);
		$result = $this->DataAdapter->execute($query,"ssssss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE sistema_acesso SET usu_grp_id = ?, fer_id = ?, ace_visualizar = ?, ace_inserir = ?, ace_alterar = ?, ace_excluir = ? WHERE ace_id = ?";
		$ace_id = $VO->get_ace_id();
		$usu_grp_id = (bool)$VO->get_usu_grp_id()?$VO->get_usu_grp_id():NULL;
		$fer_id = (bool)$VO->get_fer_id()?$VO->get_fer_id():NULL;
		$ace_visualizar = (bool)$VO->get_ace_visualizar();
		$ace_inserir = (bool)$VO->get_ace_inserir();
		$ace_alterar = (bool)$VO->get_ace_alterar();
		$ace_excluir = (bool)$VO->get_ace_excluir();
		$param = array(&$usu_grp_id, &$fer_id, &$ace_visualizar, &$ace_inserir, &$ace_alterar, &$ace_excluir, &$ace_id);
		$result = $this->DataAdapter->execute($query,"ssssssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM sistema_acesso WHERE ace_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(ace_id) as max_id FROM sistema_acesso";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>
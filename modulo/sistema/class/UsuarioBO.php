<?
require_once "UsuarioDO.php";
require_once "UsuarioVO.php";
require_once "class/Util.php";

Class UsuarioBO
{
	//Atributos
	private $UsuarioDO;
	private $Util;

	//Construtor
	function UsuarioBO()
	{
		$this->UsuarioDO = new UsuarioDO();
		$this->Util = new Util();
	}

	//Métodos
	function lista($fields, $where="", $order="", $by="", $pg=1, $regPg=15)
	{
		$where = $where?"%".$where."%":"";
		$by = $by?"DESC":"ASC";
		$pg = $pg?$pg:1;
		$limit1 = ($pg - 1) * $regPg;
		$limit2 = $regPg;
		$result = $this->UsuarioDO->lista($fields, $where, $order, $by, $limit1, $limit2);
		while($row = $result[0]->fetch_assoc())
		{
			for($i=0;$i<count($fields);$i++)
			{
				switch ($fields[$i])
				{
					case "nome_campo":
						$item[$fields[$i]] = "novo valor";
						break;
						
					default:
						$item[$fields[$i]] = $row[$fields[$i]];
						break;
				}
				if(!isset($row[$fields[$i]]))
				{
					$item[$fields[$i]] = "-";
				}
			}
			$lista[0][] = $item;
		}
		$row = $result[1]->fetch_assoc();
		$lista[1] = $row["rows"];
		return $lista;
	}

	function exibe($id)
	{
		$result = $this->UsuarioDO->exibe($id);
		$row = $result->fetch_assoc();
		$UsuarioVO = new UsuarioVO();
		$UsuarioVO->set_usu_id($row["usu_id"]);
		$UsuarioVO->set_usu_login($row["usu_login"]);
		$UsuarioVO->set_usu_senha($row["usu_senha"]);
		$UsuarioVO->set_usu_grp_id($row["usu_grp_id"]);
		$UsuarioVO->set_usu_status($row["usu_status"]);
		$UsuarioVO->set_pes_id($row["pes_id"]);
		return $UsuarioVO;
	}

	function insere($VO)
	{
		$result = $this->UsuarioDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->UsuarioDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->UsuarioDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->UsuarioDO->ultimoId();
		$row = $result->fetch_assoc();
		return $row["max_id"];
	}

	function valida($VO)
	{
		$erro = "";
		return $erro;
	}
}
?>
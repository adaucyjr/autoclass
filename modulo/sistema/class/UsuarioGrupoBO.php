<?
require_once "UsuarioGrupoDO.php";
require_once "UsuarioGrupoVO.php";
require_once "class/Util.php";

Class UsuarioGrupoBO
{
	//Atributos
	private $UsuarioGrupoDO;
	private $Util;

	//Construtor
	function UsuarioGrupoBO()
	{
		$this->UsuarioGrupoDO = new UsuarioGrupoDO();
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
		$result = $this->UsuarioGrupoDO->lista($fields, $where, $order, $by, $limit1, $limit2);
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
		$result = $this->UsuarioGrupoDO->exibe($id);
		$row = $result->fetch_assoc();
		$UsuarioGrupoVO = new UsuarioGrupoVO();
		$UsuarioGrupoVO->set_usu_grp_id($row["usu_grp_id"]);
		$UsuarioGrupoVO->set_usu_grp_nome($row["usu_grp_nome"]);
		return $UsuarioGrupoVO;
	}

	function insere($VO)
	{
		$result = $this->UsuarioGrupoDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->UsuarioGrupoDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->UsuarioGrupoDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->UsuarioGrupoDO->ultimoId();
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
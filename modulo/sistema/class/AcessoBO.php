<?
require_once "AcessoDO.php";
require_once "AcessoVO.php";
require_once "class/Util.php";

Class AcessoBO
{
	//Atributos
	private $AcessoDO;
	private $Util;

	//Construtor
	function AcessoBO()
	{
		$this->AcessoDO = new AcessoDO();
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
		$result = $this->AcessoDO->lista($fields, $where, $order, $by, $limit1, $limit2);
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
		$result = $this->AcessoDO->exibe($id);
		$row = $result->fetch_assoc();
		$AcessoVO = new AcessoVO();
		$AcessoVO->set_ace_id($row["ace_id"]);
		$AcessoVO->set_usu_grp_id($row["usu_grp_id"]);
		$AcessoVO->set_fer_id($row["fer_id"]);
		$AcessoVO->set_ace_visualizar($row["ace_visualizar"]);
		$AcessoVO->set_ace_inserir($row["ace_inserir"]);
		$AcessoVO->set_ace_alterar($row["ace_alterar"]);
		$AcessoVO->set_ace_excluir($row["ace_excluir"]);
		return $AcessoVO;
	}

	function insere($VO)
	{
		$result = $this->AcessoDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->AcessoDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->AcessoDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->AcessoDO->ultimoId();
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
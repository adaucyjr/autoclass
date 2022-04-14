<?
require_once "MovimentacaoDO.php";
require_once "MovimentacaoVO.php";
require_once "class/Util.php";

Class MovimentacaoBO
{
	//Atributos
	private $MovimentacaoDO;
	private $Util;

	//Construtor
	function MovimentacaoBO()
	{
		$this->MovimentacaoDO = new MovimentacaoDO();
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
		$result = $this->MovimentacaoDO->lista($fields, $where, $order, $by, $limit1, $limit2);
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
		$result = $this->MovimentacaoDO->exibe($id);
		$row = $result->fetch_assoc();
		$MovimentacaoVO = new MovimentacaoVO();
		$MovimentacaoVO->set_mov_id($row["mov_id"]);
		$MovimentacaoVO->set_con_id($row["con_id"]);
		$MovimentacaoVO->set_mov_valor($row["mov_valor"]);
		$MovimentacaoVO->set_mov_tipo($row["mov_tipo"]);
		$MovimentacaoVO->set_mov_descricao($row["mov_descricao"]);
		return $MovimentacaoVO;
	}

	function insere($VO)
	{
		$result = $this->MovimentacaoDO->insere($VO);
		return $result;
	}

	function atualiza($VO)
	{
		$result = $this->MovimentacaoDO->atualiza($VO);
		return $result;
	}

	function deleta($id)
	{
		$result = $this->MovimentacaoDO->deleta($id);
		return $result;
	}

	function ultimoId()
	{
		$result = $this->MovimentacaoDO->ultimoId();
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
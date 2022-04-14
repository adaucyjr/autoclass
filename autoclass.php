<?
ini_set('default_charset','UTF-8');

//ABRE O ARQUIVO SQL
$banco = fopen( "banco.sql", "r" );

//VARRE O ARQUIVO SQL PARA ENCONTRAR OS RELACIONAMENTOS ENTRE AS TABELAS
while(!feof($banco))
{
	//LÊ UMA LINHA DO ARQUIVO SQL E VERIFICA SE ELA ALTERA UMA TABELA
	$linha = fgets($banco);
	if(substr($linha, 0, 11) == "ALTER TABLE")
	{
		$tabela = explode("`", $linha)[1];
		$linha = trim(fgets($banco));
		while(substr($linha, 0, 14) == "ADD CONSTRAINT")
		{
			$relacionamento[$tabela][] = explode("`", $linha)[5];
			$linha = trim(fgets($banco));
		}
	}
}

//RETORNA PARA O INÍCIO DO ARQUIVO
rewind($banco);

//VARRE O ARQUIVO SQL PARA ENCONTRAR AS TABELAS
while(!feof($banco))
{
	//LÊ UMA LINHA DO ARQUIVO SQL E VERIFICA SE É ELA CRIA UMA TABELA
	$linha = fgets($banco);
	if(substr($linha, 0, 12) == "CREATE TABLE")
	{
		//PEGA O NOME DA TABELA
		$nomeTabela = explode("`", $linha)[1];
		
		//DEFINI O NOME DO MODULO COMO A PRIMEIRA PALAVRA ANTES DE UM _
		$nomeModulo = explode('_', $nomeTabela)[0];
		
		//DEFINI O NOME DA CLASSE COMO AS PALAVRAS DEPOIS DO PRIMEIRO _
		$nomeClasse = explode('_', $nomeTabela);
		array_shift($nomeClasse);
		
		//FORMATA O NOME DO ARQUIVO
		$nomeArquivo = implode('-',$nomeClasse);
		
		//FORMATA O NOME DA CLASSE EM CAMMEL CASE
		$nomeClasse = array_map('ucfirst', $nomeClasse);
		$nomeClasse = implode('', $nomeClasse);
		
		//CRIA UM ARRAY COM OS CAMPOS DA TABELA
		$linha = ltrim(fgets($banco));
		$campos = "";
		$chaveEstrangeira = "";
		while(substr($linha, 0, 1) == "`")
		{
			//TRATANDO A LINHA DO CAMPO PARA PEGAR SEUS ATRIBUTOS CORRETAMENTE
			$linha = trim($linha);
			$linha = str_replace("`", "", $linha);
			$linha = str_replace(",", "", $linha);
			$linha = str_replace("NOT ", "NOT_", $linha);
			$linha = str_replace("DEFAULT ", "DEFAULT_", $linha);
			$campos[] = explode(" ", $linha);
			if(strpos($linha, "int(11)") && !strpos($linha, "AUTO_INCREMENT"))
			{
				$chaveEstrangeira[] = explode(" ", $linha);
			}
			$linha = ltrim(fgets($banco));
		}
		
		//CRIA A PASTA PARA COLOCAR OS MODULOS GERADOS
		if (!file_exists('modulo'))
		{
		    mkdir('modulo', 0777, true);
		}
		
		//CRIA AS PASTAS DO MÓDULO
		if (!file_exists('modulo/'.$nomeModulo))
		{
		    mkdir('modulo/'.$nomeModulo, 0777, true);
		}
		if (!file_exists('modulo/'.$nomeModulo.'/class'))
		{
		    mkdir('modulo/'.$nomeModulo.'/class', 0777, true);
		}
		if (!file_exists('modulo/'.$nomeModulo.'/page'))
		{
		    mkdir('modulo/'.$nomeModulo.'/page', 0777, true);
		}
		
		#--------------------| INÍCIO CRIA O VALUE OBJECT (VO) |--------------------#
		//CRIA O ARQUIVO VO
		$VO = fopen('modulo/'.$nomeModulo."/class/".$nomeClasse."VO.php", "w" );
		
		fwrite($VO, "<?\n");
		
		//INICIA A CLASSE
		fwrite($VO, "Class ".$nomeClasse."VO\n");
		fwrite($VO, "{\n");
		
		//ESCREVE OS ATRIBUTOS
		fwrite($VO, "\t//Atributos\n");
		for($i=0;$i<count($campos);$i++)
		{
			fwrite($VO, "\tprivate ".'$_'.$campos[$i][0].";\n");
		}
		
		fwrite($VO, "\n");
		
		//ESCREVE OS GETS E SETS
		fwrite($VO, "\t//Propriedades\n");
		for($i=0;$i<count($campos);$i++)
		{
			//GET
			fwrite($VO, "\tfunction get_".$campos[$i][0]."()\n");
			fwrite($VO, "\t{\n");
			fwrite($VO, "\t\treturn ".'$this->_'.$campos[$i][0].";\n");
			fwrite($VO, "\t}\n");
			//SET
			fwrite($VO, "\tfunction set_".$campos[$i][0].'($value)'."\n");
			fwrite($VO, "\t{\n");
			fwrite($VO, "\t\t".'$this->_'.$campos[$i][0].' = $value;'."\n");
			fwrite($VO, "\t}\n");
			
			fwrite($VO, "\n");
		}
		
		//FINALIZA A CLASSE
		fwrite($VO, "}\n");
		
		fwrite($VO, "?>");
		
		//FECHA O ARQUIVO VO
		fclose($VO);
		
		//IMPRIME O OBJETO CRIADO NA TELA
		$VO = fopen('modulo/'.$nomeModulo."/class/".$nomeClasse."VO.php", "r" );
		echo '<code>';
		echo '<xmp>';
		while(!feof($VO))
		{
			echo fgets($VO);
		}
		echo '</xmp>';
		echo '</code>';
		fclose($VO);
		#--------------------| FIM CRIA O VALUE OBJECT (VO) |--------------------#
		
		
		
		
		#--------------------| INÍCIO CRIA O BUSINESS OBJECT (BO) |--------------------#
		//CRIA O ARQUIVO DO
		$BO = fopen('modulo/'.$nomeModulo."/class/".$nomeClasse."BO.php", "w" );
		
		fwrite($BO, "<?\n");
		
		//ESCREVE AS DEPENDÊNCIAS DO OBJETO
		fwrite($BO, 'require_once "'.$nomeClasse.'DO.php";'."\n");
		fwrite($BO, 'require_once "'.$nomeClasse.'VO.php";'."\n");
		fwrite($BO, 'require_once "class/Util.php";'."\n");
		
		fwrite($BO, "\n");
		
		//INICIA A CLASSE
		fwrite($BO, "Class ".$nomeClasse."BO\n");
		fwrite($BO, "{\n");
		
		//ESCREVE OS ATRIBUTOS
		fwrite($BO, "\t//Atributos\n");
		fwrite($BO, "\t".'private $'.$nomeClasse.'DO;'."\n");
		fwrite($BO, "\t".'private $Util;'."\n");
		fwrite($BO, "\n");
		
		//ESCREVE O CONSTRUTOR
		fwrite($BO, "\t//Construtor\n");
		fwrite($BO, "\tfunction ".$nomeClasse."BO()\n");
		fwrite($BO, "\t{\n");
		fwrite($BO, "\t\t".'$this->'.$nomeClasse.'DO = new '.$nomeClasse.'DO();'."\n");
		fwrite($BO, "\t\t".'$this->Util = new Util();'."\n");
		fwrite($BO, "\t}\n");
		
		fwrite($BO, "\n");
		
		//ESCREVE OS métodos
		fwrite($BO, "\t//Métodos\n");
		
    		//ESCREVE O método LISTA
    		fwrite($BO, "\t".'function lista($fields, $where="", $order="", $by="", $pg=1, $regPg=15)'."\n");
    		fwrite($BO, "\t{\n");
				fwrite($BO, "\t\t".'$where = $where?"%".$where."%":"";'."\n");
    		fwrite($BO, "\t\t".'$by = $by?"DESC":"ASC";'."\n");
    		fwrite($BO, "\t\t".'$pg = $pg?$pg:1;'."\n");
    		fwrite($BO, "\t\t".'$limit1 = ($pg - 1) * $regPg;'."\n");
    		fwrite($BO, "\t\t".'$limit2 = $regPg;'."\n");
    		fwrite($BO, "\t\t".'$result = $this->'.$nomeClasse.'DO->lista($fields, $where, $order, $by, $limit1, $limit2);'."\n");
				
				fwrite($BO, "\t\t".'while($row = $result[0]->fetch_assoc())'."\n");
				fwrite($BO, "\t\t".'{'."\n");
				fwrite($BO, "\t\t\t".'for($i=0;$i<count($fields);$i++)'."\n");
				fwrite($BO, "\t\t\t".'{'."\n");
				fwrite($BO, "\t\t\t\t".'switch ($fields[$i])'."\n");
				fwrite($BO, "\t\t\t\t".'{'."\n");
				fwrite($BO, "\t\t\t\t\t".'case "nome_campo":'."\n");
				fwrite($BO, "\t\t\t\t\t\t".'$item[$fields[$i]] = "novo valor";'."\n");
				fwrite($BO, "\t\t\t\t\t\t".'break;'."\n");
				fwrite($BO, "\t\t\t\t\t\t".''."\n");
				fwrite($BO, "\t\t\t\t\t".'default:'."\n");
				fwrite($BO, "\t\t\t\t\t\t".'$item[$fields[$i]] = $row[$fields[$i]];'."\n");
				fwrite($BO, "\t\t\t\t\t\t".'break;'."\n");
				fwrite($BO, "\t\t\t\t".'}'."\n");
				fwrite($BO, "\t\t\t\t".'if(!isset($row[$fields[$i]]))'."\n");
				fwrite($BO, "\t\t\t\t".'{'."\n");
				fwrite($BO, "\t\t\t\t\t".'$item[$fields[$i]] = "-";'."\n");
				fwrite($BO, "\t\t\t\t".'}'."\n");
				fwrite($BO, "\t\t\t".'}'."\n");
				fwrite($BO, "\t\t\t".'$lista[0][] = $item;'."\n");
				fwrite($BO, "\t\t".'}'."\n");
				fwrite($BO, "\t\t".'$row = $result[1]->fetch_assoc();'."\n");
				fwrite($BO, "\t\t".'$lista[1] = $row["rows"];'."\n");
    		fwrite($BO, "\t\t".'return $lista;'."\n");
    		fwrite($BO, "\t}\n");
    		
    		fwrite($BO, "\n");
    		
    		//ESCREVE O Método EXIBE
    	  fwrite($BO, "\t".'function exibe($id)'."\n");
    		fwrite($BO, "\t{\n");
    		fwrite($BO, "\t\t".'$result = $this->'.$nomeClasse.'DO->exibe($id);'."\n");
    		fwrite($BO, "\t\t".'$row = $result->fetch_assoc();'."\n");
    		fwrite($BO, "\t\t".'$'.$nomeClasse.'VO = new '.$nomeClasse.'VO();'."\n");
    		for($i=0;$i<count($campos);$i++)
    		{
    		    fwrite($BO, "\t\t".'$'.$nomeClasse.'VO->set_'.$campos[$i][0].'($row["'.$campos[$i][0].'"]);'."\n");
    		}
    		fwrite($BO, "\t\t".'return $'.$nomeClasse.'VO;'."\n");
    		fwrite($BO, "\t}\n");
    		
    		fwrite($BO, "\n");
    		
    		//ESCREVE O Método insere
    		fwrite($BO, "\t".'function insere($VO)'."\n");
    		fwrite($BO, "\t{\n");
    		fwrite($BO, "\t\t".'$result = $this->'.$nomeClasse.'DO->insere($VO);'."\n");
    		fwrite($BO, "\t\t".'return $result;'."\n");
    		fwrite($BO, "\t}\n");
    		
    		fwrite($BO, "\n");
    		
    		//ESCREVE O método atualiza
    		fwrite($BO, "\t".'function atualiza($VO)'."\n");
    		fwrite($BO, "\t{\n");
    		fwrite($BO, "\t\t".'$result = $this->'.$nomeClasse.'DO->atualiza($VO);'."\n");
    		fwrite($BO, "\t\t".'return $result;'."\n");
    		fwrite($BO, "\t}\n");
    		
    		fwrite($BO, "\n");
    		
    		//ESCREVE O método deleta
    		fwrite($BO, "\t".'function deleta($id)'."\n");
    		fwrite($BO, "\t{\n");
    		fwrite($BO, "\t\t".'$result = $this->'.$nomeClasse.'DO->deleta($id);'."\n");
    		fwrite($BO, "\t\t".'return $result;'."\n");
    		fwrite($BO, "\t}\n");
    		
    		fwrite($BO, "\n");
    		
    		//ESCREVE O método ultimoId
    		fwrite($BO, "\t".'function ultimoId()'."\n");
    		fwrite($BO, "\t{\n");
    		fwrite($BO, "\t\t".'$result = $this->'.$nomeClasse.'DO->ultimoId();'."\n");
    		fwrite($BO, "\t\t".'$row = $result->fetch_assoc();'."\n");
    		fwrite($BO, "\t\t".'return $row["max_id"];'."\n");
    		fwrite($BO, "\t}\n");
    		
    		fwrite($BO, "\n");
    		
    		//ESCREVE O método valida
    		fwrite($BO, "\t".'function valida($VO)'."\n");
    		fwrite($BO, "\t{\n");
    		fwrite($BO, "\t\t".'$erro = "";'."\n");
    		fwrite($BO, "\t\t".'return $erro;'."\n");
    		fwrite($BO, "\t}\n");
		
		//FINALIZA A CLASSE
		fwrite($BO, "}\n");
		
		fwrite($BO, "?>");
		
		//FECHA O ARQUIVO BO
		fclose($BO);
		
		//IMPRIME O OBJETO CRIADO NA TELA
		$BO = fopen('modulo/'.$nomeModulo."/class/".$nomeClasse."BO.php", "r" );
		echo '<code>';
		echo '<xmp>';
		while(!feof($BO))
		{
			echo fgets($BO);
		}
		echo '</xmp>';
		echo '</code>';
		fclose($BO);
		#--------------------| FIM CRIA O BUSINESS OBJECT (BO) |--------------------#
		
		
		
		
		#--------------------| INÍCIO CRIA O DATA OBJECT (DO) |--------------------#
		//CRIA O ARQUIVO DO
		$DO = fopen('modulo/'.$nomeModulo."/class/".$nomeClasse."DO.php", "w" );
		
		fwrite($DO, "<?\n");
		
		//ESCREVE AS DEPENDÊNCIAS DO OBJETO
		fwrite($DO, 'require_once "class/DataAdapter.php";'."\n");
		
		fwrite($DO, "\n");
		
		//INICIA A CLASSE
		fwrite($DO, "Class ".$nomeClasse."DO\n");
		fwrite($DO, "{\n");
		
		//ESCREVE OS ATRIBUTOS
		fwrite($DO, "\t//Atributos\n");
		fwrite($DO, "\t".'private $DataAdapter;'."\n");
		fwrite($DO, "\n");
		
		//ESCREVE O CONSTRUTOR
		fwrite($DO, "\t//Construtor\n");
		fwrite($DO, "\tfunction ".$nomeClasse."DO()\n");
		fwrite($DO, "\t{\n");
		fwrite($DO, "\t\t".'$this->DataAdapter = new DataAdapter();'."\n");
		fwrite($DO, "\t}\n");
		
		fwrite($DO, "\n");
		
		//ESCREVE OS métodos
		fwrite($DO, "\t//Métodos\n");
		
    		//ESCREVE O método lista
    		fwrite($DO, "\t".'function lista($fields, $where, $order, $by, $limit1, $limit2)'."\n");
    		fwrite($DO, "\t{\n");
				fwrite($DO, "\t\t".'$type = "";'."\n");
				fwrite($DO, "\t\t".'$param = array();'."\n");
    		fwrite($DO, "\t\t".'$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";'."\n");
    		fwrite($DO, "\t\t".'$query .= "FROM '.$nomeTabela.' ');
				if(count($relacionamento[$nomeTabela]))
				{
					for($i=0;$i<count($relacionamento[$nomeTabela]);$i++)
					{
						if($chaveEstrangeira[$i][2] == "NOT_NULL")
						{
							fwrite($DO, 'NATURAL JOIN '.$relacionamento[$nomeTabela][$i].' ');
						}
						else
						{
							fwrite($DO, 'LEFT JOIN '.$relacionamento[$nomeTabela][$i].' ON '.$nomeTabela.'.'.$chaveEstrangeira[$i][0].' = '.$relacionamento[$nomeTabela][$i].'.'.$chaveEstrangeira[$i][0].' ');
						}
					}
				}
				fwrite($DO, '";'."\n");
    		fwrite($DO, "\t\t".'if($where != "")'."\n");
    		fwrite($DO, "\t\t".'{'."\n");
				fwrite($DO, "\t\t\t".'$query .= "WHERE ".$fields[0]." LIKE ? ";'."\n");
				fwrite($DO, "\t\t\t".'for($i=1;$i<count($fields);$i++)'."\n");
				fwrite($DO, "\t\t\t".'{'."\n");
				fwrite($DO, "\t\t\t\t".'$query .= "OR ".$fields[$i]." LIKE ? ";'."\n");
				fwrite($DO, "\t\t\t".'}'."\n");
				fwrite($DO, "\t\t\t".'$param[] = &$where;'."\n");
				fwrite($DO, "\t\t\t".'for($i=1;$i<count($fields);$i++)'."\n");
				fwrite($DO, "\t\t\t".'{'."\n");
				fwrite($DO, "\t\t\t\t".'$param[] = &$where;'."\n");
				fwrite($DO, "\t\t\t".'}'."\n");
				fwrite($DO, "\t\t\t".'for($i=0;$i<count($fields);$i++)'."\n");
				fwrite($DO, "\t\t\t".'{'."\n");
				fwrite($DO, "\t\t\t\t".'$type .= "s";'."\n");
				fwrite($DO, "\t\t\t".'}'."\n");
    		fwrite($DO, "\t\t".'}'."\n");
    		fwrite($DO, "\t\t".'if($order != "")'."\n");
    		fwrite($DO, "\t\t".'{'."\n");
    		fwrite($DO, "\t\t\t".'$query .= "ORDER BY ".$order." ".$by." ";'."\n");
    		fwrite($DO, "\t\t".'}'."\n");
    		fwrite($DO, "\t\t".'else'."\n");
    		fwrite($DO, "\t\t".'{'."\n");
    		fwrite($DO, "\t\t\t".'$query .= "ORDER BY '.$campos[0][0].' DESC ";'."\n");
    		fwrite($DO, "\t\t".'}'."\n");
    		fwrite($DO, "\t\t".'if(is_int($limit1) && is_int($limit2))'."\n");
    		fwrite($DO, "\t\t".'{'."\n");
    		fwrite($DO, "\t\t\t".'$query .= "LIMIT ".$limit1.", ".$limit2;'."\n");
    		fwrite($DO, "\t\t".'}'."\n");
    		fwrite($DO, "\t\t".'$lista = $this->DataAdapter->execute($query,$type,$param,1);'."\n");
    		fwrite($DO, "\t\t".'return $lista;'."\n");
    		fwrite($DO, "\t}\n");
    		
    		fwrite($DO, "\n");
    		
    		//ESCREVE O método exibe
    	  fwrite($DO, "\t".'function exibe($id)'."\n");
    		fwrite($DO, "\t{\n");
    		fwrite($DO, "\t\t".'$query = "SELECT * FROM '.$nomeTabela.' WHERE '.$campos[0][0].' = ?";'."\n");
				fwrite($DO, "\t\t".'$param = array(&$id);'."\n");
    		fwrite($DO, "\t\t".'$result = $this->DataAdapter->execute($query,"i",$param);'."\n");
    		fwrite($DO, "\t\t".'return $result;'."\n");
    		fwrite($DO, "\t}\n");
    		
    		fwrite($DO, "\n");
    		
    		//ESCREVE O método insere
    		fwrite($DO, "\t".'function insere($VO)'."\n");
    		fwrite($DO, "\t{\n");
    		fwrite($DO, "\t\t".'$query = "INSERT INTO '.$nomeTabela.' VALUES (\'\'');
    		for($i=1;$i<count($campos);$i++)
    		{
    			fwrite($DO, ', ?');
    		}
    		fwrite($DO, ')";'."\n");
				for($i=1;$i<count($campos);$i++)
    		{
    			switch ($campos[$i][1])
    			{
						case 'tinyint(1)':
							fwrite($DO, "\t\t".'$'.$campos[$i][0].' = (bool)$VO->get_'.$campos[$i][0].'();'."\n");
							break;
						
						case 'int(11)':
							fwrite($DO, "\t\t".'$'.$campos[$i][0].' = (bool)$VO->get_'.$campos[$i][0].'()?$VO->get_'.$campos[$i][0].'():NULL;'."\n");
							break;
						
						default:
							fwrite($DO, "\t\t".'$'.$campos[$i][0].' = $VO->get_'.$campos[$i][0].'();'."\n");
							break;
					}
    		}
				fwrite($DO, "\t\t".'$param = array(&$'.$campos[1][0]);
				for($i=2;$i<count($campos);$i++)
    		{
    			fwrite($DO, ', &$'.$campos[$i][0]);
    		}
				fwrite($DO, ');'."\n");
    		fwrite($DO, "\t\t".'$result = $this->DataAdapter->execute($query,"');
				for($i=1;$i<count($campos);$i++)
    		{
    			fwrite($DO, 's');
    		}
				fwrite($DO, '",$param);'."\n");
    		fwrite($DO, "\t\t".'return $result;'."\n");
    		fwrite($DO, "\t}\n");
    		
    		fwrite($DO, "\n");
    		
    		//ESCREVE O método atualiza
    		fwrite($DO, "\t".'function atualiza($VO)'."\n");
    		fwrite($DO, "\t{\n");
    		fwrite($DO, "\t\t".'$query = "UPDATE '.$nomeTabela.' SET '.$campos[1][0].' = ?');
    		for($i=2;$i<count($campos);$i++)
    		{
    			fwrite($DO, ', '.$campos[$i][0].' = ?');
    		}
				fwrite($DO, ' WHERE '.$campos[0][0].' = ?";'."\n");
				fwrite($DO, "\t\t".'$'.$campos[0][0].' = $VO->get_'.$campos[0][0].'();'."\n");
				for($i=1;$i<count($campos);$i++)
    		{
    			switch ($campos[$i][1])
    			{
						case 'tinyint(1)':
							fwrite($DO, "\t\t".'$'.$campos[$i][0].' = (bool)$VO->get_'.$campos[$i][0].'();'."\n");
							break;
						
						case 'int(11)':
							fwrite($DO, "\t\t".'$'.$campos[$i][0].' = (bool)$VO->get_'.$campos[$i][0].'()?$VO->get_'.$campos[$i][0].'():NULL;'."\n");
							break;
						
						default:
							fwrite($DO, "\t\t".'$'.$campos[$i][0].' = $VO->get_'.$campos[$i][0].'();'."\n");
							break;
					}
    		}
				fwrite($DO, "\t\t".'$param = array(&$'.$campos[1][0]);
				for($i=2;$i<count($campos);$i++)
    		{
    			fwrite($DO, ', &$'.$campos[$i][0]);
    		}
    		fwrite($DO, ', &$'.$campos[0][0]);
				fwrite($DO, ');'."\n");
    		fwrite($DO, "\t\t".'$result = $this->DataAdapter->execute($query,"');
				for($i=1;$i<count($campos);$i++)
    		{
    			fwrite($DO, 's');
    		}
				fwrite($DO, 'i');
				fwrite($DO, '",$param);'."\n");
    		fwrite($DO, "\t\t".'return $result;'."\n");
    		fwrite($DO, "\t}\n");
    		
    		fwrite($DO, "\n");
    		
    		//ESCREVE O método deleta
    		fwrite($DO, "\t".'function deleta($id)'."\n");
    		fwrite($DO, "\t{\n");
    		fwrite($DO, "\t\t".'$query = "DELETE FROM '.$nomeTabela.' WHERE '.$campos[0][0].' = ?";'."\n");
				fwrite($DO, "\t\t".'$param = array(&$id);'."\n");
    		fwrite($DO, "\t\t".'$result = $this->DataAdapter->execute($query,"i",$param);'."\n");
    		fwrite($DO, "\t\t".'return $result;'."\n");
    		fwrite($DO, "\t}\n");
    		
    		fwrite($DO, "\n");
    		
    		//ESCREVE O método ultimoId
    		fwrite($DO, "\t".'function ultimoId()'."\n");
    		fwrite($DO, "\t{\n");
    		fwrite($DO, "\t\t".'$query = "SELECT MAX('.$campos[0][0].') as max_id FROM '.$nomeTabela.'";'."\n");
    		fwrite($DO, "\t\t".'$result = $this->DataAdapter->execute($query);'."\n");
    		fwrite($DO, "\t\t".'return $result;'."\n");
    		fwrite($DO, "\t}\n");
		
		//FINALIZA A CLASSE
		fwrite($DO, "}\n");
		
		fwrite($DO, "?>");
		
		//FECHA O ARQUIVO DO
		fclose($DO);
		
		//IMPRIME O OBJETO CRIADO NA TELA
		$DO = fopen('modulo/'.$nomeModulo."/class/".$nomeClasse."DO.php", "r" );
		echo '<code>';
		echo '<xmp>';
		while(!feof($DO))
		{
			echo fgets($DO);
		}
		echo '</xmp>';
		echo '</code>';
		fclose($DO);
		#--------------------| FIM CRIA O DATA OBJECT (DO) |--------------------#
		
		
		
		
		#--------------------| INÍCIO CRIA O CONTROLLER OBJECT (CO) |--------------------#
		//CRIA O ARQUIVO CO
		$CO = fopen('modulo/'.$nomeModulo."/page/".$nomeArquivo.".co.php", "w" );
		fwrite($CO, "<?\n");
		
		//ESCREVE AS DEPENDÊNCIAS CO OBJETO
		fwrite($CO, 'require_once "class/ControllerMaster.php";'."\n");
		fwrite($CO, 'require_once "modulo/'.$nomeModulo.'/class/'.$nomeClasse.'BO.php";'."\n");
		fwrite($CO, "\n");
		
		//INICIA A CLASSE
		fwrite($CO, "Class ".$nomeClasse.' extends ControllerMaster'."\n");
		fwrite($CO, "{\n");
		
		//ESCREVE OS métodos
		fwrite($CO, "\t".'//Métodos'."\n");
		
		//Método LISTAR
		fwrite($CO, "\t".'function listar()'."\n");
		fwrite($CO, "\t".'{'."\n");
		fwrite($CO, "\t\t".'$this->DataGrid = new DataGrid($this->BO, "'.$campos[0][0].'");'."\n");
		fwrite($CO, "\t\t".'$this->DataGrid->set_btInserir("'.$nomeModulo.'/'.$nomeArquivo.'/inserir");'."\n");
		for($i=0;$i<count($campos);$i++)
		{
			if($campos[$i][1] != 'char(41)')
			{
				fwrite($CO, "\t\t".'$this->DataGrid->set_field("'.$campos[$i][0].'", "'.strtoupper($campos[$i][0]).'", "", "");'."\n");
			}
		}
		fwrite($CO, "\t\t".'$this->DataGrid->set_tool("Exibir", "'.$nomeModulo."/".$nomeArquivo.'", "glyphicon glyphicon-file", "Exibir");'."\n");
		fwrite($CO, "\t\t".'if($this->Seguranca->verificaAcesso("excluir", $this->page))'."\n");
		fwrite($CO, "\t\t".'{'."\n");
		fwrite($CO, "\t\t\t".'$this->DataGrid->set_tool("Excluir", "'.$nomeModulo."/".$nomeArquivo.'", "glyphicon glyphicon-trash", "Excluir", "Excluir");'."\n");
		fwrite($CO, "\t\t".'}'."\n");
		fwrite($CO, "\t\t".'$this->lista = $this->DataGrid->show();'."\n");
		fwrite($CO, "\t\t".'$this->Seguranca->registraLog($this->url, "l");'."\n");
		fwrite($CO, "\t".'}'."\n");
		fwrite($CO, "\t"."\n");
		
		//Método INSERIR
		fwrite($CO, "\t".'function inserir()'."\n");
		fwrite($CO, "\t".'{'."\n");
		fwrite($CO, "\t\t".'$this->Seguranca->validaAcesso("inserir", $this->page);'."\n");
		fwrite($CO, "\t".'}'."\n");
		fwrite($CO, "\t"."\n");
		
		//Método EXIBIR
		fwrite($CO, "\t".'function exibir()'."\n");
		fwrite($CO, "\t".'{'."\n");
		fwrite($CO, "\t\t".'if(isset($_GET["id"]) && (int)$_GET["id"])'."\n");
		fwrite($CO, "\t\t".'{'."\n");
		fwrite($CO, "\t\t\t".'$this->VO = $this->BO->exibe((int)$_GET["id"]);'."\n");
		fwrite($CO, "\t\t\t".'if(!(int)$this->VO->get_'.$campos[0][0].'())'."\n");
		fwrite($CO, "\t\t\t".'{'."\n");
		fwrite($CO, "\t\t\t\t".'header("Location:".$this->redirect);'."\n");
		fwrite($CO, "\t\t\t\t".'exit;'."\n");
		fwrite($CO, "\t\t\t".'}'."\n");
		fwrite($CO, "\t\t\t".'$this->Seguranca->registraLog($this->url, "v");'."\n");
		fwrite($CO, "\t\t".'}'."\n");
		fwrite($CO, "\t\t".'else'."\n");
		fwrite($CO, "\t\t".'{'."\n");
		fwrite($CO, "\t\t\t".'header("Location:".$this->redirect);'."\n");
		fwrite($CO, "\t\t\t".'exit;'."\n");
		fwrite($CO, "\t\t".'}'."\n");
		fwrite($CO, "\t".'}'."\n");
		fwrite($CO, "\t"."\n");
		
		//Método EDITAR
		fwrite($CO, "\t".'function editar()'."\n");
		fwrite($CO, "\t".'{'."\n");
		fwrite($CO, "\t\t".'$this->Seguranca->validaAcesso("alterar", $this->page);'."\n");
		fwrite($CO, "\t\t".'$this->exibir();'."\n");
		fwrite($CO, "\t".'}'."\n");
		fwrite($CO, "\t"."\n");
		
		//Método SALVAR
		fwrite($CO, "\t".'function salvar()'."\n");
		fwrite($CO, "\t".'{'."\n");
		for($i=0;$i<count($campos);$i++)
		{
			fwrite($CO, "\t\t".'$this->VO->set_'.$campos[$i][0].'($_POST["'.$campos[$i][0].'"]);'."\n");
		}
		fwrite($CO, "\t\t".'if((int)$this->VO->get_'.$campos[0][0].'())'."\n");
		fwrite($CO, "\t\t".'{'."\n");
		fwrite($CO, "\t\t\t".'$this->Seguranca->validaAcesso("alterar", $this->page);'."\n");
		fwrite($CO, "\t\t\t".'$this->BO->atualiza($this->VO);'."\n");
		fwrite($CO, "\t\t\t".'$this->Seguranca->registraLog($this->url, "a");'."\n");
		fwrite($CO, "\t\t\t".'$_SESSION["msg"] = "Sucesso! Registro atualizado com sucesso.";'."\n");
		fwrite($CO, "\t\t\t".'header("Location:".$this->redirect."/editar/".$this->VO->get_'.$campos[0][0].'());'."\n");
		fwrite($CO, "\t\t\t".'exit;'."\n");
		fwrite($CO, "\t\t".'}'."\n");
		fwrite($CO, "\t\t".'else'."\n");
		fwrite($CO, "\t\t".'{'."\n");
		fwrite($CO, "\t\t\t".'$this->Seguranca->validaAcesso("inserir", $this->page);'."\n");
		fwrite($CO, "\t\t\t".'$this->BO->insere($this->VO);'."\n");
		fwrite($CO, "\t\t\t".'$this->Seguranca->registraLog($this->url, "i");'."\n");
		fwrite($CO, "\t\t\t".'$this->VO->set_'.$campos[0][0].'($this->BO->ultimoId());'."\n");
		fwrite($CO, "\t\t\t".'$_SESSION["msg"] = "Sucesso! Registro inserido com sucesso.";'."\n");
		fwrite($CO, "\t\t\t".'header("Location:".$this->redirect."/editar/".$this->VO->get_'.$campos[0][0].'());'."\n");
		fwrite($CO, "\t\t\t".'exit;'."\n");
		fwrite($CO, "\t\t".'}'."\n");
		fwrite($CO, "\t".'}'."\n");
		fwrite($CO, "\t"."\n");
		
		//Método EXCLUIR
		fwrite($CO, "\t".'function excluir()'."\n");
		fwrite($CO, "\t".'{'."\n");
		fwrite($CO, "\t\t".'$this->Seguranca->validaAcesso("excluir", $this->page);'."\n");
		fwrite($CO, "\t\t".'$this->BO->deleta((int)$_GET["id"]);'."\n");
		fwrite($CO, "\t\t".'$this->Seguranca->registraLog($this->url, "e");'."\n");
		fwrite($CO, "\t\t".'$_SESSION["msg"] = "Sucesso! O registro foi excluído com sucesso.";'."\n");
		fwrite($CO, "\t\t".'header("Location:".$this->redirect);'."\n");
		fwrite($CO, "\t\t".'exit;'."\n");
		fwrite($CO, "\t".'}'."\n");
		fwrite($CO, "\t"."\n");
		
		fwrite($CO, "\tfunction onLoad()\n");
		fwrite($CO, "\t".'{'."\n");
		fwrite($CO, "\t\t".''."\n");
		fwrite($CO, "\t".'}'."\n");
		fwrite($CO, "\t"."\n");
		
		//FINALIZA A CLASSE
		fwrite($CO, "}\n");
		
		fwrite($CO, "\n");
		
		fwrite($CO, '$'.$nomeClasse.' = new '.$nomeClasse.'("'.$nomeArquivo.'", "'.$nomeModulo.'", "'.$nomeClasse.'");'."\n");
		
		fwrite($CO, "?>");
		
		//FECHA O ARQUIVO CO
		fclose($CO);
		
		//IMPRIME O OBJETO CRIADO NA TELA
		$CO = fopen('modulo/'.$nomeModulo."/page/".$nomeArquivo.".co.php", "r" );
		echo '<code>';
		echo '<xmp>';
		while(!feof($CO))
		{
			echo fgets($CO);
		}
		echo '</xmp>';
		echo '</code>';
		fclose($CO);
		#--------------------| FIM CRIA O CONTROLLER OBJECT (CO) |--------------------#
		
		
		
		
		#--------------------| INÍCIO CRIA O FORM OBJECT (FO) |--------------------#
		//CRIA O ARQUIVO FO
		$FO = fopen('modulo/'.$nomeModulo."/page/".$nomeArquivo.".php", "w" );
		fwrite($FO, '<? require "'.$nomeArquivo.'.co.php" ?>'."\n");
		fwrite($FO, '<h1 class="page-header"><? echo $'.$nomeClasse.'->title ?></h1>'."\n");
		fwrite($FO, '<? if($'.$nomeClasse.'->acao == "inserir" || $'.$nomeClasse.'->acao == "editar" || $'.$nomeClasse.'->acao == "exibir"){ ?>'."\n");
		fwrite($FO, '<form id="form_'.$nomeArquivo.'" method="post" onkeypress="return noSubmitEnter(event)">'."\n");
		
		//ESCREVE OS INPUTS
		fwrite($FO, "\t".'<input type="hidden" name="'.$campos[0][0].'" value="<? echo $'.$nomeClasse.'->VO->get_'.$campos[0][0].'() ?>" />'."\n");
		fwrite($FO, "\t".'<div class="row">'."\n");
		for($i=1;$i<count($campos);$i++)
		{
			fwrite($FO, "\t\t".'<div class="col-md-12 form-group">'."\n");
			fwrite($FO, "\t\t\t".'<label for="'.$campos[$i][0].'">'.$campos[$i][0].':</label>'."\n");
			
			//DEFINE A CLASSE DO INPUT
			$class = 'form-control';
			
			//DEFINE O TAMANHO MÁXIMO DO INPUT
			$maxlength = substr($campos[$i][1], strpos($campos[$i][1], '(')+1, strpos($campos[$i][1], ')')-strpos($campos[$i][1], '(')-1);
			
			//VERIFICA O TIPO DE INPUT
			if(substr($campos[$i][1], 0, 4) == 'char' && $campos[$i][1] != 'char(41)')
			{
				$type = 'number';
			}
			else
			{
				switch ($campos[$i][1])
				{
					case 'char(41)':
						$type = 'password';
						$maxlength = '20';
						break;
					
					case 'date':
						$type = 'date';
						break;
						
					case 'tinyint(1)':
						$type = 'checkbox';
						$maxlength = '';
						$class = '';
						break;
						
					case 'varchar(31)':
						$type = 'email';
						break;
					
					case 'int(11)':
						$type = 'select';
						$maxlength = '';
						break;
					
					default:
						$type = 'text';
						break;
				}
			}
			
			//VERIFICA SE O CAMPO PODE SER NULO
			if($campos[$i][2] == "NOT_NULL" AND $type != "checkbox")
			{
				$required = "required";
			}
			else
			{
				$required = "";
			}
			
			//VERIFICA SE É O PRIMEIRO INPUT E SETA O AUTOFOCUS
			if($i == 1)
			{
				$autofocus = "autofocus";
			}
			else
			{
				$autofocus = "";
			}
			
			switch($type)
			{
				case 'select':
					fwrite($FO, "\t\t\t".'<? echo $'.$nomeClasse.'->Util->geraSelect("'.$campos[$i][0].'", "'.array_shift($relacionamento[$nomeTabela]).'", "'.$campos[$i][0].'", "'.$campos[$i][0].'", "", "", "'.$campos[$i][0].'", $'.$nomeClasse.'->VO->get_'.$campos[$i][0].'(), "'.$class.'"); ?>'."\n");
					break;
				
				case 'checkbox':
					fwrite($FO, "\t\t\t".'<input id="'.$campos[$i][0].'" name="'.$campos[$i][0].'" type="'.$type.'" <? if((bool)$'.$nomeClasse.'->VO->get_'.$campos[$i][0].'()){echo "checked";} ?> '.$required.' '.$autofocus.' class="'.$class.'" />'."\n");
					break;
				
				default:
					fwrite($FO, "\t\t\t".'<input id="'.$campos[$i][0].'" name="'.$campos[$i][0].'" type="'.$type.'" maxlength="'.$maxlength.'" value="<? echo $'.$nomeClasse.'->VO->get_'.$campos[$i][0].'() ?>" '.$required.' '.$autofocus.' class="'.$class.'" />'."\n");
					break;
			}
			
			fwrite($FO, "\t\t".'</div>'."\n");
		}
		fwrite($FO, "\t".'</div>'."\n");
		
		//ESCREVE O SUBMIT
		fwrite($FO, "\t".'<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit">');
		fwrite($FO, '<input type="button" value="Voltar" onclick="location=\'<? echo $'.$nomeClasse.'->redirect ?>\'" class="btn btn-danger" />'."\n");
		fwrite($FO, '</form>'."\n");
		
		fwrite($FO, '<? } if($'.$nomeClasse.'->acao == "listar") { echo $'.$nomeClasse.'->lista; } ?>');
		
		//FECHA O ARQUIVO FO
		fclose($FO);
		
		//IMPRIME O OBJETO CRIADO NA TELA
		$FO = fopen('modulo/'.$nomeModulo."/page/".$nomeArquivo.".php", "r" );
		echo '<code>';
		echo '<xmp>';
		while(!feof($FO))
		{
			echo fgets($FO);
		}
		echo '</xmp>';
		echo '</code>';
		fclose($FO);
		#--------------------| FIM CRIA O FORM OBJECT (FO) |--------------------#
	}
}

fclose($banco);
?>

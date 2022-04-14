<?
Class MovimentacaoVO
{
	//Atributos
	private $_mov_id;
	private $_con_id;
	private $_mov_valor;
	private $_mov_tipo;
	private $_mov_descricao;

	//Propriedades
	function get_mov_id()
	{
		return $this->_mov_id;
	}
	function set_mov_id($value)
	{
		$this->_mov_id = $value;
	}

	function get_con_id()
	{
		return $this->_con_id;
	}
	function set_con_id($value)
	{
		$this->_con_id = $value;
	}

	function get_mov_valor()
	{
		return $this->_mov_valor;
	}
	function set_mov_valor($value)
	{
		$this->_mov_valor = $value;
	}

	function get_mov_tipo()
	{
		return $this->_mov_tipo;
	}
	function set_mov_tipo($value)
	{
		$this->_mov_tipo = $value;
	}

	function get_mov_descricao()
	{
		return $this->_mov_descricao;
	}
	function set_mov_descricao($value)
	{
		$this->_mov_descricao = $value;
	}

}
?>
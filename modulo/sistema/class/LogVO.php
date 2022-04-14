<?
Class LogVO
{
	//Atributos
	private $_log_id;
	private $_usu_id;
	private $_log_data_hora;
	private $_log_ip;
	private $_log_tela;
	private $_log_acao;

	//Propriedades
	function get_log_id()
	{
		return $this->_log_id;
	}
	function set_log_id($value)
	{
		$this->_log_id = $value;
	}

	function get_usu_id()
	{
		return $this->_usu_id;
	}
	function set_usu_id($value)
	{
		$this->_usu_id = $value;
	}

	function get_log_data_hora()
	{
		return $this->_log_data_hora;
	}
	function set_log_data_hora($value)
	{
		$this->_log_data_hora = $value;
	}

	function get_log_ip()
	{
		return $this->_log_ip;
	}
	function set_log_ip($value)
	{
		$this->_log_ip = $value;
	}

	function get_log_tela()
	{
		return $this->_log_tela;
	}
	function set_log_tela($value)
	{
		$this->_log_tela = $value;
	}

	function get_log_acao()
	{
		return $this->_log_acao;
	}
	function set_log_acao($value)
	{
		$this->_log_acao = $value;
	}

}
?>
<?
Class CargoVO
{
	//Atributos
	private $_car_id;
	private $_car_nome;
	private $_car_salario;

	//Propriedades
	function get_car_id()
	{
		return $this->_car_id;
	}
	function set_car_id($value)
	{
		$this->_car_id = $value;
	}

	function get_car_nome()
	{
		return $this->_car_nome;
	}
	function set_car_nome($value)
	{
		$this->_car_nome = $value;
	}

	function get_car_salario()
	{
		return $this->_car_salario;
	}
	function set_car_salario($value)
	{
		$this->_car_salario = $value;
	}

}
?>
<?php
/***********************************************
Clase para la conexion a la base de datos

Author: Miguel Carmona
************************************************/

class Db
{
	private $_server;
	private $_user;
	private $_pass;
	private $_db;

	// Datos de conexion por defecto
	public function __construct()
	{
		// Incluimos el archivo de configuracion
		// Ubicado en el directorio raiz
		//include $_SERVER['DOCUMENT_ROOT'].'/config.php';

		// Añadimos los parametros de conexion
		$this->_server = 'localhost';
		$this->_user = 'xymind';
		$this->_pass = '';
		$this->_db = 'pibd';
	}
	// Funcion para obtener informacion (SELECT)
	public function mysqli_select($sql)
	{
		// Creamos un nuevo objeto mysqli
		$mysqli = new mysqli($this->_server,$this->_user,$this->_pass,$this->_db);

		// Probamos la conexion
		if($mysqli->connect_errno){
			// Si nos da error al conectar mostramos mensaje
			die('Error al conectar a la base de datos: '.$mysqli->connect_errno);
		}
		
		// Si no hay exito en la  consulta mostramos el error
		if(!$result = $mysqli->query($sql)){
			// Error en la consulta
			die('Error en la consulta: '.$mysqli->error);
		}

		// Cerramos la conexion a la base de datos
		$mysqli->close();

		return $result;
	}
	// Funcion para insertar, actualizar o eliminar registros 
	// (INSERT, DELETE, UPDATE)
	public function mysqli_action($sql)
	{
		// Creamos un nuevo objeto mysqli
		$mysqli = new mysqli($this->_server,$this->_user,$this->_pass,$this->_db);

		// Probamos la conexion
		if($mysqli->connect_errno){
			// Si nos da error al conectar mostramos mensaje
			die('Error al conectar a la base de datos: '.$mysqli->connect_errno);
		}
		// Si hay error al insertar el registro lo mostramos
		if(!$result = $mysqli->query($sql)){
			// Error al insertar
			die('Error en la consulta: '.$mysqli->error);
		}

		// Obtenemos el ID del registro que acabamos de insertar
		$id = $mysqli->insert_id;

		// Obtenemos el total de filas afectadas
		$affected_rows = $mysqli->affected_rows;

		// Cerramos la conexion a la base de datos
		$mysqli->close();

		// Retornamos el ID del registro que acabamos de insertar
		return $id;
	}
	// Esta funcion obtiene registros 
	public function mysqli_result($res, $row, $field=0)
	{
	    $res->data_seek($row);
	    $datarow = $res->fetch_array();
	    
	    return $datarow[$field];
	}
	// Funcion para escapar una cadena para almacenar en base de datos
	public function mysqli_secure($string)
	{
		// Creamos un nuevo objeto mysqli
		$mysqli = new mysqli($this->_server,$this->_user,$this->_pass,$this->_db);
		// Probamos la conexion
		if($mysqli->connect_errno){
			// Si nos da error al conectar mostramos mensaje
			die('Error al conectar a la base de datos: '.$mysqli->connect_errno);
		}
		
		// Escapamos la cadena
		$string = $mysqli->real_escape_string($string);
		// Cerramos la conexion a la base de datos
		$mysqli->close();
		// Retornamos la cadena
		return $string;
	}

}

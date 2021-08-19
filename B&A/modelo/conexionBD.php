
<?php
function conectar() {//este metodo inicia la conexion a la base de datos
    try {
        $servername = 'localhost'; //nombre del servidor
        $username_DB = 'root'; //usuario de la base de datos
        $password = 'root'; //contraseña de la base de datos para el usuario
        $dbname = 'B&A'; //nombre de la base de datos
        $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username_DB, $password); //conecta la base con PDO
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set el modo error PDO para exepción
        return $conexion; //retorna esa conexion
    } catch (PDOException $ex) {//si no se puede conectar
        header('Location: ../vista/error.php?t=2');
    }
}

//Consulta la base y retorna el resultado
function consultarBase($consultar, $conexion, $arreglo) {
    $query = $conexion->prepare($consultar);
    $query->execute($arreglo);
    return $query->fetch(PDO::FETCH_ASSOC);
}

//Consulta la base y no retorna el resultado	
function consultarBaseSinRetornar($consultar, $conexion, $arreglo) {
    $query = $conexion->prepare($consultar);
    return $query->execute($arreglo);
}

function desconectar($conexion){
    $conexion=null;
}

function consultarXML($elemento,$atributo,$ruta){
    if(file_exists($ruta))
        return simplexml_load_file($ruta)->$elemento->$atributo;
    else
        return '0';
}

function editarXML($elemento,$atributo,$ruta,$dato){
    if(file_exists($ruta)){
        $xml = simplexml_load_file($ruta);
        unset($xml->$elemento);
        $obj = $xml->addChild($elemento);
        $obj->addChild($atributo,$dato);
        $xml->asXML($ruta); 
        return '1';
    }
    else
        return '0';
}

//------------------------------OTRAS FUNCIONES
function filterDateTime($fecha){
    $dia = substr($fecha, -11, 2);
    $numMes = substr($fecha, -14, 2);
    $hora = substr($fecha, -8, 5);
    $mes = '';
    switch ($numMes)
    {
        case '01':
            $mes = 'Enero';
            break;
        case '02':
            $mes = 'Febrero';
            break;
        case '03':
            $mes = 'Marzo';
            break;
        case '04':
            $mes = 'Abril';
            break;
        case '05':
            $mes = 'Mayo';
            break;
        case '06':
            $mes = 'Junio';
            break;
        case '07':
            $mes = 'Julio';
            break;
        case '08':
            $mes = 'Agosto';
            break;
        case '09':
            $mes = 'Setiembre';
            break;
        case '10':
            $mes = 'Octubre';
            break;
        case '11':
            $mes = 'Noviembre';
            break;
        case '12':
            $mes = 'Diciembre';
            break;
    }
    $anno = substr($fecha, -19, 4);
    return $mes.' '.$dia.', '.$anno.' ('.$hora.')';
}
function filterDate($fecha){
    $dia = substr($fecha, -2, 2);
    $numMes = substr($fecha, -5, 2);
    $mes = '';
    switch ($numMes){
        case '01':
            $mes = 'Enero';
            break;
        case '02':
            $mes = 'Febrero';
            break;
        case '03':
            $mes = 'Marzo';
            break;
        case '04':
            $mes = 'Abril';
            break;
        case '05':
            $mes = 'Mayo';
            break;
        case '06':
            $mes = 'Junio';
            break;
        case '07':
            $mes = 'Julio';
            break;
        case '08':
            $mes = 'Agosto';
            break;
        case '09':
            $mes = 'Setiembre';
            break;
        case '10':
            $mes = 'Octubre';
            break;
        case '11':
            $mes = 'Noviembre';
            break;
        case '12':
            $mes = 'Diciembre';
            break;
    }
    $anno = substr($fecha, -10, 4);
    return $dia.' '.$mes.', '.$anno;
}
function generarContraseña(){
    return substr(md5(microtime()), 1, 5);
}

function diferenciaMesesEntreFechas($fecha1,$fecha2){
    return intval((strtotime($fecha1)-strtotime($fecha2))/60/60/24/31);
}

function filterMoney($moneda,$monto){
    if($moneda === '0')
        return '&#162;'.number_format ($monto,0,',','.');
    else
        return '&#36;'.number_format ($monto,0,',','.');
}
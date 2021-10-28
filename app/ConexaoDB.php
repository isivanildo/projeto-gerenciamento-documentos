<?php

//Ler os arquivos de configurção onde está declarado as constantes para conexão com o banco de dados
require_once("config.php");

//Classe responsável po fazer a conexão com o banco de dados
//Ivanildo Ferreira
abstract class ConexaoDB {

    private static $Host = HOST;
    private static $User = USER;
    private static $Pass = PASS;
    private static $Dbsa = DBSA;

    private static $Connect = null;

    private static function Conectar() {
        try {
            if (self::$Connect == null) {
                $dsn = 'mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa;
                $options = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$Connect = new PDO($dsn, self::$User, self::$Pass, $options);
            }
        }
        catch (PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }

        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Connect;
    }

    /** Retorna um objeto do tipo PDO */
    protected static function getConn() {
           return self::Conectar();
    }    
}
?>
<?php

//Arquivo Connection.php
class Connection {

    private static $conn = null;

    public static function getConnection() {

        if(self::$conn == null) {
            try {
                $opcoes = array(//Define o charset da conexão
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
                    //Define o tipo do erro como exceção 
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    //Define o tipo de retorno como array associativo (campo => valor)
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

                //Cria a conexão...
                $strConn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
                self::$conn = new PDO($strConn, DB_USER, DB_PASSWORD, $opcoes);
            } catch(PDOException $e) {
                echo "Erro ao conectar na base de dados.<br>";
                print_r($e);
            }
        }
        return self::$conn;
    } 
}
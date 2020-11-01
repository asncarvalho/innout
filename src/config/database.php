<?php
// AULA CLASSE DATABASE #01 Arquivo que vai representar o acesso ao banco de dados
class Database {
    //Função que faz a conexão com o banco de dados
    public static function getConnection(){
        $envPath = realpath(dirname(__FILE__) . '/../env.ini');
        $env = parse_ini_file($envPath);
        //vai receber chave = valor
        $conn = new mysqli($env['host'], $env['username'], 
            $env['password'], $env['database']);
        if($conn->connect_error) {
            die("Erro: " . $conn->connect_error);
        }
        
        return $conn;
    }
    // Aula CLASSE DATABASE #02 FUNÇÃO QUE RECEBE UM RESULT SET, QUE MOSTRA A LISTA DE USUÁRIOS DIRETAMENTE NA PÁGINA

    public static function getResultFromQuery($sql){
        $conn = self::getConnection();
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public static function executeSQL($sql){
        $conn = self::getConnection();
        if(!mysqli_query($conn, $sql)){
            echo mysqli_error($conn);
            throw new Exception(mysqli_error($conn));
        }
        $id = $conn->insert_id;
        $conn->close();
        return $id;
    }
}



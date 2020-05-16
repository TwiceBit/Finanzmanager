<?php
require 'Config.php';
class Database {

    public static $connection = null;

    function init(){


        Database::$connection = new mysqli(Config::$host, Config::$user, Config::$password, Config::$Database);
        if(mysqli_error(Database::$connection)){
            echo mysqli_error(Database::$connection);
            exit;
        }

        if(!mysqli_stat(Database::$connection)){

            echo "Es ist ein Fehler aufgetreten.";
            
        }


        Database::$connection->query("CREATE TABLE IF NOT EXISTS Finanzen (id int not null AUTO_INCREMENT PRIMARY KEY, beschreibung Varchar(255), betrag DOUBLE)");
        
    }

    function addTransaktion($beschreibung, $betrag){
        
        if(Database::$connection == null){
            Database::init();
        }
        
        $prepare = Database::$connection->prepare("insert into Finanzen (beschreibung, betrag) VALUES (?, ?)");
        
        if($prepare){
            $prepare->bind_param("sd", $description, $money);
            $description = $beschreibung;
            $money = $betrag;
            $prepare->execute();
        }
    }

    function getAllTransactions(){
        

        if(Database::$connection == null){
            Database::init();
        }

        $data = Database::$connection->query("SELECT beschreibung, betrag FROM Finanzen");

        if(!$data){
            
            if(mysqli_error(Database::$connection)){
                echo mysqli_error(Database::$connection);
                echo "\n";
             
            }
            return [];
        }

        

        return $data;
    }

    function getReverseAllTransactions(){
        

        if(Database::$connection == null){
            Database::init();
        }
        
        $data = Database::$connection->query("SELECT beschreibung, betrag FROM Finanzen order by id DESC");

        if(!$data){
            echo "Error\n";
            if(mysqli_error(Database::$connection)){
                echo mysqli_error(Database::$connection);
                echo "\n";
             
            }
            return [];
        }

        

        return $data;
    }

}


?>
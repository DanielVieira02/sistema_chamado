<?php
    function carregar_logins($conn){
        $query = "SELECT * FROM Login;";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function carregar_setores($conn){
        $query = "SELECT * FROM Setor;";
        $result = mysqli_query($conn, $query);
        return $result;
    }

?>
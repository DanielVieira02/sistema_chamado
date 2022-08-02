<?php 

    include_once("conexao.php");
    
    $tabela_chamados = "Chamado";
    $tabela_arquivos = "Arquivo";

    function enviarChamado($loginId, $setorId, $problema, $momentoAberto){     
        global $conn, $tabela_chamados;

        $query = "INSERT INTO $tabela_chamados (LoginId, SetorId, Problema, MomentoAberto) VALUES ('$loginId', '$setorId', '$problema', '$momentoAberto')";
        $result = mysqli_query($conn, $query);
        
        if($result)
            return mysqli_insert_id($conn);
        else
            return -1;
    }
  
    function processarChamado(){
        $formatosAceitos = array('image/png', 'image/jpeg', '');

        $loginId  = $_POST['login'];
        $setorId  = $_POST['setor'];
        $problema = $_POST['problema'];
        
        $momentoAberto = new DateTime();
        
        $inputData = $_POST['data'];
        $inputHora = $_POST['hora'];

        $momentoAberto = date("Y-m-d H:i:s", strtotime($inputData . ' ' . $inputHora));

        $anexos = $_FILES['anexos'];

        if(!empty($anexos)){
            if(!in_array($anexos['type'], $formatosAceitos)){
                echo 'Formato de arquivo inválido.';
                feedbackPagina(false);
                die();
            }
            else{
                $idChamado = enviarChamado($loginId, $setorId, $problema, $momentoAberto);
                $retorno = salvarArquivo($anexos, "arquivos/");
                vincularArquivo($idChamado, $retorno['nome'], "arquivos/");
            }
        }
        else{
            enviarChamado($loginId, $setorId, $problema, $momentoAberto->format('Y-m-d-H-i-s'));
        }

        feedbackPagina(true);
    }

    function vincularArquivo($idChamado, $nomeArquivo, $path){
        global $tabela_arquivos, $conn;
        $query = "INSERT INTO $tabela_arquivos (ChamadoId, Nome, Path) VALUES ('$idChamado', '$nomeArquivo', '$path')";
        $result = mysqli_query($conn, $query);
    }

    function salvarArquivo($arquivo, $diretorio){
        global $conn;
        
        $nomeDoArquivo = $arquivo['name'];
        $novoNome = uniqid(rand(), true);
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    
        $retorno['status'] = move_uploaded_file($arquivo["tmp_name"], $diretorio . $novoNome . "." . $extensao);
        $retorno['nome'] = $novoNome;

        return $retorno;
    }  

    function feedbackPagina($sucesso){
        if ($sucesso){
            paginaSucesso();
        }
        else{
            paginaErro();
        }
    
    }

    function paginaSucesso(){
        echo '<p style="color: green";> Sucesso! </p>';
    }

    function paginaErro(){
        echo '<p style="color: red";> Falha... </p>';
    }

    processarChamado();
?>
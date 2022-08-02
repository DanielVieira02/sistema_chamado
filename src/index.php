<?php 
    include_once("conexao.php");
    include_once("carrega_dados.php");  
    $logins = carregar_logins($conn);
    $setores = carregar_setores($conn);
?>

<html>
    <link rel="stylesheet" type="text/css" href="index.css" />
    <meta charset="UTF-8">
 <head>
  <title>Sistema de Chamados</title>
 </head>
 <body>

     
     <div class="cabecalho">
         <h1>SISTEMA DE CHAMADO</h1>
        </div>
        
    <section class="content">

        <h2 style="text-align: center; padding-top: 50px;">Dados Gerais</h2>
        
    <div class="formulario">

        <form action="enviar_dados.php" method="POST" enctype="multipart/form-data">
            <div class="campos">

                <label for="data">* Data</label>
                <br>
                <input class="campo-formulario" name="data" type="date">

                <label for="hora">* Hora</label>
                <br>
                <input class="campo-formulario" name="hora" type="time">

                <label for="login">* Login Relator</label>
                <br>
                <select class="campo-formulario" name="login">
                <?php
                        while ($row = mysqli_fetch_assoc($logins)):;
                    ?>
                        <option value="<?php echo $row["Id"];?>">
                            <?php echo $row["Login"]; ?>
                        </option>
                    <?php 
                        endwhile;
                    ?>
                </select>

                <label for="setor">* Setor</label>
                <br>
                <select class="campo-formulario" name="setor">
                    <?php
                        while ($row = mysqli_fetch_assoc($setores)):;
                    ?>
                        <option value="<?php echo $row["Id"];?>">
                            <?php echo $row["Nome"]; ?>
                        </option>
                    <?php 
                        endwhile;
                    ?>
                </select>

                <label for="problema">* Problema</label>
                <br>
                <textarea class="campo-formulario" name="problema" rows="10"></textarea>

                <label for="anexos">Arquivos</label>
                <br>
                <input name="anexos" type="file" multiple>

            </div>
            
            <div class="confirma" style="padding-top: 20px">
                <input type="submit" value="OK">
            </div>
        </form>
    </div>

</section>

 </body>
</html>
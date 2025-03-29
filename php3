<?php
	/// Declara as variáveis
	$id = ''; 
    // Verifica se parâmetro [id] foi enviado pelo método POST
    if (isset($_POST['id'])){
        $id = $_POST['id'];
    }
    // Abre (IO) conexao com a base de dados / SGBD...
    $connection = mysqli_connect('localhost','root','123456','curso');        
    if (!$connection) {    
        echo 'Erro na conexao';
        exit;
    }       
	// Se id em branco
	if ($id == '')
	   {
	   echo 'ID em branco';
	   exit;	  
	   } 
	
	 
    // Constroi a instrução (UPDATE)  para alterar o registro
    $msgSQL = 'DELETE FROM ALUNO WHERE ID = '.$id;
    // Grava o registro no BD
    $mySqlQuery = mysqli_query($connection, $msgSQL);
    if (!$mySqlQuery){
        echo 'Não consegui excluir o registro';                  
        exit;
    }

    // Abre a tabela
    $mySqlQuery = mysqli_query($connection, 'SELECT ID, NOME FROM ALUNO'); 
    if (!$mySqlQuery){  
       echo 'Erro de leitura na tabela ALUNO';                  
       exit;
    }
    // Retorna todos os registros:
    $records = mysqli_fetch_all($mySqlQuery, MYSQLI_ASSOC);
    // Imprimi todos os registros
    echo '<hr>';
    foreach ($records as $fields){
             echo 'ID '. $fields['ID'].' NOME '. $fields['NOME']. ' <br>'; 	
    }
    echo '<hr>';        
    // Fecha a BD
    mysqli_close($connection);   
?>

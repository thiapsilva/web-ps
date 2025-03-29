<?php
	/// Declara as variáveis
	$id = ''; $nome = '';
    // Verifica se parâmetro [id, nome] foi enviado pelo método POST
    if (isset($_POST['id'])){
        $id = $_POST['id'];
    }
	if (isset($_POST['nome'])){
	    $nome = $_POST['nome'];
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
    $msgSQL = 'UPDATE ALUNO SET NOME =  "'.$nome.'" WHERE ID = '.$id;
    
ECHO $msgSQL;

// Grava o registro no BD
    $mySqlQuery = mysqli_query($connection, $msgSQL);
    if (!$mySqlQuery){
        echo 'Não consegui alterar o registro';                  
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

    print_r ($records);

exit;

    // Imprimi todos os registros
    echo '<hr>';
    foreach ($records as $fields){
             echo 'ID '. $fields['ID'].' NOME '. $fields['NOME']. ' <br>'; 	
    }
    echo '<hr>';        
    // Fecha a BD
    mysqli_close($connection);   
?>

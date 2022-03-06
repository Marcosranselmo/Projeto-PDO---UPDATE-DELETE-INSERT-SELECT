<?php
//------------------------CONEXÃO-------------------------------------
try 
{
     $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost","root","");
} 
catch (PDOException $e) {
    echo "Erro com banco de dados: ".$e->getMessage();
}
catch(Exception $e)
{
    echo "Erro generico: ".$e->getMessage();;
}


//-------------------INSERÇÃO DE DADOS---------------------
// 1ª forma
//$res = $pdo->prepare("INSERT INTO PESSOA (nome, telefone, email)
//    VALUES (:n, :t, :e)");

//$res->bindValue(":n","Lucas Azevedo");
//$res->bindValue(":t","11931256487");
//$res->bindValue(":e","azevedo@bol.com");
//$res->execute();

// 2ª forma
//$pdo->query("INSERT INTO PESSOA (nome, telefone, email) 
//VALUES('Azevedo Lucas do Prado','11945687521','azevedo@gmail.com')");

//-----------------------------DELETE E UPDATE --------------------------------
//1 Forma
//$cmd = $pdo->prepare("DELETE FROM PESSOA WHERE id = :id");
//$id = 6;
//$cmd->bindValue(":id",$id);
//$cmd->execute();

//2 forma 
//$res = $pdo->query("DELETE FROM PESSOA WHERE id = '4'")

//---------------------Atualizar dados com UPDATE-------------------------------
//1 forma
//$cmd = $pdo->prepare("UPDATE PESSOA SET email = :e WHERE id = :id");
//$cmd->bindValue(":e", "azevedo@terra.com.br");
//$cmd->bindValue(":id",8);
//$cmd->execute();

//2 forma
//$res = $pdo->query("UPDATE PESSOA SET email = 'azevedo2@hotmail.com' WHERE id = '8'");

//-----------------------------SELECT-----------------------------------------
$cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$cmd->bindValue(":id",7);
$cmd->execute();
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);

foreach ($resultado as $key => $value)
{
    echo $key.": ".$value."<br>";
}

//echo "<pre>";
//print_r($resultado);
//echo "<pre>";




?>
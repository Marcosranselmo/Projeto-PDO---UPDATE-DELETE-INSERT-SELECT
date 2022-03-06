<?php 

Class Pessoa{

    private $pdo;
    //CONEXAO COM O BANCO DE DADOS
    public function __construct($dbname, $host, $user, $senha)
    {
        try
        {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        }
        catch (PDOException $e) {
            echo "Erro com banco de dados: ".$e->getMessage();
            exit();
        }
        catch (Exception $e) {
            echo "Erro generico: ".$e->getMessage();
            exit();
        }
    }

    //FUNCAO PARA BUSXAR DADOS E COLOCAR NA TELA LADO DIREITO 
    public function buscarDados()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome ");
        $res = $cmd->fetchALL(PDO::FETCH_ASSOC);
        return $res;
    }
    //FUNCAO DE CADASTRAR PESSOAS NO BANCO DE DADOS
    public function cadastrarPessoa($nome, $telefone, $email)
    {
        //ANTES DE CADASTRAR VERIFICAR SE JA TEM O EMAIL CADASTRADO
        $cmd = $this->pdo->prepare("SELECT id from pessoa WHERE email = :e");
        $cmd->bindValue(":e",$email);
        $cmd->execute(); 
        if($cmd->rowCount() > 0) //email ja existe no banco
        {
            return false;
        }else //nao foi encontrado o email
        {
            $cmd = $this->pdo->prepare("INSERT INTO pessoa (
                nome, telefone, email) VALUES (:n, :t, :e)");
                $cmd->bindValue(":n",$nome);
                $cmd->bindValue(":t",$telefone);
                $cmd->bindValue(":e",$email);
                $cmd->execute();
                return true;
        }
    }

    //FUNCAO DE EXCLUIR PESSOA
    public function excluirPessoa($id)
    {
        $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
    }

    // BUSCAR DADOS DE UMA PESSOA PARA IDITAR
    public function buscarDadosPessoa($id)
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    // ATUALIZAR DADOS NO BANCO DE DADOS
    
    public function atualizarDados($id, $nome, $telefone, $email)
    {
            $cmd = $this->pdo->prepare("UPDATE pessoa SET nome = :n, 
            telefone = :t, email = :e WHERE id= :id");
            $cmd->bindValue(":n",$nome);
            $cmd->bindValue(":t",$telefone);
            $cmd->bindValue(":e",$email);
            $cmd->bindValue(":id",$id);
            $cmd->execute();
            return true;
        }
    }
?>
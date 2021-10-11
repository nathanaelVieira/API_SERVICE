<?php

    require_once 'config.php';

    class request {

        public static function select(int $ra)
        {

            $tab = "usuario";
            $col = "ra";

            $connPDO = new \PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "select * from $tab where $col = :ra";
            $stmt = $connPDO->prepare($sql);

            $stmt->bindValue(':ra',$ra);
            $stmt->execute();	

            if ( $stmt->rowCount() > 0 ){
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("E-mail não encontrado");
            }
        }

        public static function selectAll() 
        {
            $tab = "usuario";
            $connPDO = new \PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "select * from $tab";
            $stmt = $connPDO->prepare($sql);
            $stmt->execute();

            if ( $stmt->rowCount() > 0 ){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Sem registro");
            }
        } 

        public static function insert($dados)
        {

            $tab = "usuario";
        
            $connPdo = new \PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "insert into $tab ( nome, email, senha) values ( :nome, :email, :senha)"  ;
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':nome' , $dados['nome']) ;
            $stmt->bindValue(':email' , $dados['email']);
            $stmt->bindValue(':senha' , $dados['senha']);
            $stmt->execute() ;

            if ($stmt->rowCount() > 0)
            {  
                return 'Dados cadastrados com sucesso';
            }else{
                throw new \Exception("Erro ao inserir os dados");
            }
        }

        public static function alterar($ra, $dados) 
        {
            $tab = "usuario";
            $col = "ra";
            $connPDO = new \PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "update $tab set nome=:nome, email=:email, senha=:senha where $col = :ra";
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':ra' , $ra);
            $stmt->bindValue(':nome', $dados['nome']);
            $stmt->bindValue(':email', $dados['email']);
            $stmt->bindValue(':senha', $dados['senha']);
            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                return 'Dados alterados com sucesso';
            }else{
                throw new \Exception("Erro ao alterar os dados");
            }
        }

        public static function delete(int $ra)
        {
            $tab = "usuario";
            $col = "ra";

            $connPdo = new \PDO(dbDrive.':host='.dbHost.'; dbname='.dbName, dbUser, dbPass);
            $sql = "delete from $tab where $col = :ra"  ;
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':ra' , $ra) ;
            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                return 'Dados excluídos com sucesso';
            }else{
                throw new \Exception("Erro ao excluir os dados");
            }
        }
    }



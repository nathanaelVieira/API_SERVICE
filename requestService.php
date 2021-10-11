<?php

include 'request.php';
class requestService{

    public function get($ra = null) 
    {

        if ($ra) {
            return request::select($ra);
        } else {
            return request::selectAll();
        }
    }

    public function post()
    {
        $dados = $_POST;
        return request::insert($dados);

    }

    public function put($ra = null)
    {
        if($id == null ){
          throw new \Exception("Falta o ra");
        }
        $dados = json_decode(file_get_contents('php://input'), true, 512);
        if($dados == null ){
          throw new \Exception("Faltou as informações para alterar");
        }
        return Alunos::alterar( $ra, $dados);              
    }

    public function delete($ra = null)
    {
        if($ra == null ){
          throw new \Exception("Falta o código");
        }
        return Alunos::delete($ra);   
    }


}
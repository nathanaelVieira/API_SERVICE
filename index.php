<?php

    include 'requestService.php';

    header("Content-Type: application/json; charset=UTF-8;");
    //header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");  // Necessário para a mesma máquina (localhost)
    //header('Access-Control-Allow-Origin: http://localhost:4200');

    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
    header("Access-Control: no-cache, no-store, must-revalidate");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Max-Age: 86400");
       

    if($_GET['url']){
       
        $url = explode('/' , $_GET['url']);
        

        if($url[0] === 'api' ){

            array_shift($url);

            $service = ucfirst( $url[0]).'Service' ;
            array_shift($url);
            
            
            $method = strtolower( $_SERVER['REQUEST_METHOD']);
           
            try {
              $response =  call_user_func_array(array( new  $service , $method), $url) ;

              http_response_code(200) ; // ok
              //echo json_encode( array('sucesso' => true , 'mensagem' => '' , 'dados' => $response));
              echo json_encode( array($response));

            } catch (\Exception $e) {

              http_response_code(404) ; // erro
              echo json_encode( array('sucesso' => false , 'mensagem' => $e->getMessage() , 'dados' => []));
            }

        }
    }

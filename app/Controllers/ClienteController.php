<?php


namespace App\Controllers;

 
use App\Requests\CustomRequestHandler;
use App\Response\CustomResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use Respect\Validation\Validator as v;
use App\Validation\Validator;

class ClienteController
{
    protected  $customResponse;

    protected  $validator;

    public function __construct(){

        $this->customResponse = new CustomResponse();

        $this->validator = new Validator();

    } 

    public function deudas(Request $request , Response $response){
        #validar campos vacios
        $this->validator->validate($request,[
            "documento"=>v::notEmpty()
            
         ]);
          
        if($this->validator->failed())
        {
            $responseMessage = $this->validator->errors;
            return $this->customResponse->is400Response($response,$responseMessage);
        }
        
        $getBody = json_decode($request->getBody(),true);
        $apiInternet = $this->apiInternet(CustomRequestHandler::getParam($request,"documento"));
        
        $responseMessage = $apiInternet;
        $this->customResponse->is200Response($response,$responseMessage);
    }

    public function apiInternet($documento)
    {
        $data = array(
            "documento"=> $documento,
            "key" => "f24f0aaa81db035965e65f60c5e54c41",
            "m" => 1
        );
        $ch =   curl_init("http://10.111.39.3/api/api_internet/v2/public/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);
        if($response->success==false) {
                return false;
        }else{
                return $response->data;
        }


    }


}

?>
<?php


namespace App\Controller;


use App\Formulaire\FormEanType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    function index(Request $request){
        return $this->render("base.html.twig", []);
        }

    /**
     * @Route("/response", name="response", methods={"GET"})
     * @return int
     */
        function response(Request $request){
            $ean = $request->get("ean");
            $somme = 0;
            for ($i = 0; $i < 11; $i++ ){
                if (($i+1)%2 == 0){
                    $somme += ((int)$ean[$i])*3;
                }else{
                    $somme += (int)$ean[$i];
                }
            }
            $reste = $somme % 10;
            if ($reste == 0){
                $keyResponse = 0;
            }else{
                $keyResponse = 10-($reste);
            }
            return new JsonResponse(json_encode($keyResponse));
        }
}
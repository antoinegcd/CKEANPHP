<?php


namespace App\Controller;


use App\Formulaire\FormEanType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    function index(Request $request){
        $form = $this->createForm(FormEanType::class);
        $form->handleRequest($request);
        $ean = "";
        if ($form->isSubmitted() && $form->isValid()){
            $ean = $form->getExtraData();

            $split = str_split((int)$ean, 1);
            $somme = 0;
            $keyResponse = 0;
            foreach ($split as $key=>$value){
                if (is_float(($key+1)/2)){
                    $somme += $value;
                }
                else{
                    $somme += $value*3;
                }
            }
            if ($somme%10 == 0)
                $keyResponse = 0;
            else
                $keyResponse = 10-(somme%10);

            return $this->render('base.html.twig', array(
                "form" => $form->createView(),
                "response" => $keyResponse,
            ));
        }
        return $this->render("base.html.twig",[
            "form" => $form->createView(),
            "response" => ""
        ]);
    }
}
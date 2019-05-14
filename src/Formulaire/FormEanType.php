<?php


namespace App\Formulaire;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;

class FormEanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', TextType::class, [
                "label" => "Code EAN",
                "attr" => ['pattern'=>'[0-9]{12}'],
                "required" => true
            ]);
    }

}
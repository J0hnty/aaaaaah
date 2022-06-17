<?php

namespace App\Controller;

use App\Entity\Bestelregel;
use App\Entity\Category;
use App\Form\AddCategoryType;
use App\Repository\BestelregelRepository;
use App\Repository\CategoryRepository;
use App\Repository\KlantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * @Route("/pizza", name="app_pizza")
     */
    public function index(KlantRepository $em): Response
    {
        $repository = $em->findAll();

        return $this->render('pizza/index.html.twig', [
            'controller_name' => 'PizzaController',
            'klanten' => $repository
        ]);
    }
    /**
     * @Route("/form", name="app_form")
     */
    public function form(Request $request, CategoryRepository $em) {
        $category = new Category();

        $form = $this->createForm(addCategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->add($form->getData(), true);
        }
        return $this->renderForm('pizza/form.html.twig', [
            'form' => $form
        ]);
    }
}

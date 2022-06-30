<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArgonautUserRepository;


use App\Entity\ArgonautUser;
use App\Form\CreateArgonautFormType;
use Doctrine\ORM\EntityManagerInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="app_main")
     */
    public function index(Request $request, EntityManagerInterface $em, ArgonautUserRepository $ArgonautUsers): Response
    {
        $newArgonaut = new ArgonautUser;
        $ArgonautUser= $ArgonautUsers->findAll();
        $form = $this->createForm(CreateArgonautFormType::class, $newArgonaut);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($newArgonaut);
            $em->flush();

            $this->addFlash('success', 'Argonaut ajouté avec succès !');
            return $this->redirectToRoute('app_main');
        }

        return $this->render('main/argonautForm.html.twig', [
            'newArgonautForm' => $form->createView(),
            'ArgonautUsers' => $ArgonautUser,
        ]);
    }
}

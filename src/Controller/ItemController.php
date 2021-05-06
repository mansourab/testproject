<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\ItemFormType;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function home()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/items", name="item_index")
     */
    public function index(ItemRepository $repository): Response
    {
        $items = $repository->findAll();

        return $this->render('item/index.html.twig', [
            'items' => $items,
        ]);
    }

    /**
     * @Route("/item/create", name="item_create")
     * @return Response
     */
    public function createItem(Request $request, EntityManagerInterface $em)
    {
        $item = new Item();

        $form = $this->createForm(ItemFormType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($item);
            $em->flush();
        }

        return $this->render('item/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class ContactController extends AbstractController
{
    #[Route('/', name: 'contact_index')]
    public function index(Request $request, ContactRepository $contactRepository, PaginatorInterface $paginator, EntityManagerInterface $entityManager): Response
    {
        // Création d'un nouveau contact pour l'ajout
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();
    
            $this->addFlash('success', 'Contact ajouté avec succès.');
            return $this->redirectToRoute('contact_index');
        }
    
        // Gestion de la recherche
        $searchTerm = $request->query->get('search', '');
    
        // Recherche avec query builder sur les champs 'nom' et 'email'
        $queryBuilder = $contactRepository->createQueryBuilder('c')
            ->where('c.nom LIKE :searchTerm OR c.email LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%');
    
        // Pagination des résultats de la recherche
        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1), // Numéro de page
            10 // Limite par page
        );
    
        return $this->render('contact/index.html.twig', [
            'contacts' => $pagination,
            'form' => $form->createView(),
            'searchTerm' => $searchTerm,
        ]);
    }
    

    #[Route('/contact/{id}/edit', name: 'contact_edit')]
    public function edit(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Le contact a été modifié avec succès.');

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contact/{id}/delete', name: 'contact_delete')]
    public function delete(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Le contact a été supprimé avec succès.');
        }

        return $this->redirectToRoute('contact_index');
    }
}

<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BlogBundle\Entity\Author;
use BlogBundle\Form\AuthorType;

/**
 * Author controller.
 *
 */
class AuthorController extends Controller
{
    /**
     * Lists all Author entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $authors = $em->getRepository('BlogBundle:Author')->findAll();

        return $this->render('author/index.html.twig', array(
            'authors' => $authors,
        ));
    }

    /**
     * Creates a new Author entity.
     *
     */
    public function newAction(Request $request)
    {
        $author = new Author();
        $form = $this->createForm('BlogBundle\Form\AuthorType', $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute('admin_author_show', array('id' => $author->getId()));
        }

        return $this->render('author/new.html.twig', array(
            'author' => $author,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Author entity.
     *
     */
    public function showAction(Author $author)
    {
        $deleteForm = $this->createDeleteForm($author);

        return $this->render('author/show.html.twig', array(
            'author' => $author,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Author entity.
     *
     */
    public function editAction(Request $request, Author $author)
    {
        $deleteForm = $this->createDeleteForm($author);
        $editForm = $this->createForm('BlogBundle\Form\AuthorType', $author);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute('admin_author_edit', array('id' => $author->getId()));
        }

        return $this->render('author/edit.html.twig', array(
            'author' => $author,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Author entity.
     *
     */
    public function deleteAction(Request $request, Author $author)
    {
        $form = $this->createDeleteForm($author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($author);
            $em->flush();
        }

        return $this->redirectToRoute('admin_author_index');
    }

    /**
     * Creates a form to delete a Author entity.
     *
     * @param Author $author The Author entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Author $author)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_author_delete', array('id' => $author->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

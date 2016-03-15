<?php

namespace A2xMyEnglishBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use A2xMyEnglishBundle\Entity\Words;
use A2xMyEnglishBundle\Form\WordsType;

/**
 * Words controller.
 *
 * @Route("/")
 */
class WordsController extends Controller
{
    /**
     * Lists all Words entities.
     *
     * @Route("/", name="_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {

        $MySearchForm = $this->createForm('A2xMyEnglishBundle\Form\SearchForm');
        //$MySearchForm->handleRequest($request);
        print_r ( $request->request->get('search_form'));
echo '1';
        //if ($MySearchForm->isSubmitted() && $MySearchForm->isValid()) {
        if ($request->request->get('search_form')){
            $searchData=$request->request->get('search_form');
            echo $searchData['id'];
            $searchId=$searchData['id'];
            return $this->redirectToRoute('_show', array('id' => $searchId));
    }


        //    $em = $this->getDoctrine()->getManager();
        //    $em->getRepository('A2xMyEnglishBundle:Words')->find(2);
        //    $em->persist($word);
          //  $em->flush();
    //            return $this->redirectToRoute('_show', array('id' => $word->getId()));
        //}

        $em = $this->getDoctrine()->getManager();

        $words = $em->getRepository('A2xMyEnglishBundle:Words')->findAll();

        return $this->render('words/index.html.twig', array(
            'words' => $words,
            'search_form' => $MySearchForm ->createView(),
        ));
    }

    /**
     * Creates a new Words entity.
     *
     * @Route("/new", name="_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $word = new Words();
        $form = $this->createForm('A2xMyEnglishBundle\Form\WordsType', $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($word);
            $em->flush();

            return $this->redirectToRoute('_show', array('id' => $word->getId()));
        }

        return $this->render('words/new.html.twig', array(
            'word' => $word,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Words entity.
     *
     * @Route("/{id}", name="_show",
     *    requirements={
    "id": "\d+"
     * }
     * )
     * @Method("GET")
     */
    public function showAction(Words $word)
    {
        $deleteForm = $this->createDeleteForm($word);

        return $this->render('words/show.html.twig', array(
            'word' => $word,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Words entity.
     *
     * @Route("/{id}/edit", name="_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Words $word)
    {
        $deleteForm = $this->createDeleteForm($word);
        $editForm = $this->createForm('A2xMyEnglishBundle\Form\WordsType', $word);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($word);
            $em->flush();

            return $this->redirectToRoute('_edit', array('id' => $word->getId()));
        }

        return $this->render('words/edit.html.twig', array(
            'word' => $word,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Words entity.
     *
     * @Route("/{id}", name="_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Words $word)
    {
        $form = $this->createDeleteForm($word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($word);
            $em->flush();
        }

        return $this->redirectToRoute('_index');
    }

    /**
     * Creates a form to delete a Words entity.
     *
     * @param Words $word The Words entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Words $word)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_delete', array('id' => $word->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace BarbadusBundle\Controller;

use BarbadusBundle\Entity\Barbeiro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Barbeiro controller.
 *
 * @Route("barbeiro")
 */
class BarbeiroController extends Controller
{
    /**
     * Lists all barbeiro entities.
     *
     * @Route("/", name="barbeiro_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $barbeiros = $em->getRepository('BarbadusBundle:Barbeiro')->findAll();

        return $this->render('BarbadusBundle:Barbeiro:index.html.twig', array(
            'barbeiros' => $barbeiros,
        ));
    }

    /**
     * Creates a new barbeiro entity.
     *
     * @Route("/new", name="barbeiro_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $barbeiro = new Barbeiro();
        $form = $this->createForm('BarbadusBundle\Form\BarbeiroType', $barbeiro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($barbeiro);
            $em->flush();

            return $this->redirectToRoute('barbeiro_show', array('id' => $barbeiro->getId()));
        }

        return $this->render('BarbadusBundle:Barbeiro:new.html.twig', array(
            'barbeiro' => $barbeiro,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a barbeiro entity.
     *
     * @Route("/{id}", name="barbeiro_show")
     * @Method("GET")
     */
    public function showAction(Barbeiro $barbeiro)
    {
        $deleteForm = $this->createDeleteForm($barbeiro);

        return $this->render('BarbadusBundle:Barbeiro:show.html.twig', array(
            'barbeiro' => $barbeiro,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing barbeiro entity.
     *
     * @Route("/{id}/edit", name="barbeiro_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Barbeiro $barbeiro)
    {
        $deleteForm = $this->createDeleteForm($barbeiro);
        $editForm = $this->createForm('BarbadusBundle\Form\BarbeiroType', $barbeiro);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('barbeiro_edit', array('id' => $barbeiro->getId()));
        }

        return $this->render('BarbadusBundle:Barbeiro:edit.html.twig', array(
            'barbeiro' => $barbeiro,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a barbeiro entity.
     *
     * @Route("/{id}", name="barbeiro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Barbeiro $barbeiro)
    {
        $form = $this->createDeleteForm($barbeiro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($barbeiro);
            $em->flush();
        }

        return $this->redirectToRoute('barbeiro_index');
    }

    /**
     * Creates a form to delete a barbeiro entity.
     *
     * @param Barbeiro $barbeiro The barbeiro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Barbeiro $barbeiro)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('barbeiro_delete', array('id' => $barbeiro->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

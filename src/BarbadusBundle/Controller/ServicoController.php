<?php

namespace BarbadusBundle\Controller;

use BarbadusBundle\Entity\Servico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Servico controller.
 *
 * @Route("servico")
 */
class ServicoController extends Controller
{
    /**
     * Lists all servico entities.
     *
     * @Route("/", name="servico_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $ordenar = $request->get('ordenar');

        $ordenar = ($ordenar != "")? $ordenar : "nome";
        
        
        
        $em = $this->getDoctrine()->getManager();

        $servicos = $em->getRepository('BarbadusBundle:Servico')
                ->findBy(array(), array($ordenar => "ASC"));

       
        
        return $this->render('BarbadusBundle:Servico:index.html.twig', array(
            'servicos' => $servicos,
        ));
    }

    /**
     * Creates a new servico entity.
     *
     * @Route("/new", name="servico_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        
        $servico = new Servico();
                
        $form = $this->createForm('BarbadusBundle\Form\ServicoType', $servico);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servico);
            $em->flush($servico);

            return $this->redirectToRoute('servico_show', array('id' => $servico->getId()));
        }

        return $this->render('BarbadusBundle:Servico:new.html.twig', array(
            'servico' => $servico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a servico entity.
     *
     * @Route("/{id}", name="servico_show")
     * @Method("GET")
     */
    public function showAction(Servico $servico)
    {
        $deleteForm = $this->createDeleteForm($servico);

        return $this->render('BarbadusBundle:Servico:show.html.twig', array(
            'servico' => $servico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing servico entity.
     *
     * @Route("/edit/{id}", name="servico_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Servico $servico)
    {
               
        $deleteForm = $this->createDeleteForm($servico);
        $editForm = $this->createForm('BarbadusBundle\Form\ServicoType', $servico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('servico_edit', array('id' => $servico->getId()));
        }

        return $this->render('BarbadusBundle:Servico:edit.html.twig', array(
            'servico' => $servico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a servico entity.
     *
     * @Route("/{id}", name="servico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Servico $servico)
    {
        $form = $this->createDeleteForm($servico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($servico);
            $em->flush();
        }

        return $this->redirectToRoute('servico_index');
    }

    /**
     * Creates a form to delete a servico entity.
     *
     * @param Servico $servico The servico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Servico $servico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('servico_delete', array('id' => $servico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

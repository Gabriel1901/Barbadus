<?php

namespace BarbadusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {        
        $em = $this->getDoctrine()->getManager();
        
        $servicos = $em->getRepository('BarbadusBundle:Servico')
                ->findBy(array(), array( 'nome' => 'ASC'));
        
        return $this->render('BarbadusBundle:Default:index.html.twig', array(
            'servicos' => $servicos
            
        ));
    }
    
    public function profissionaisAction()
    {
    
        
        
    }
}

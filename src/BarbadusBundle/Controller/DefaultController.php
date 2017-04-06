<?php

namespace BarbadusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use \BarbadusBundle\Entity\Agendamento;

class DefaultController extends Controller
{

    /**
     * @Route("/")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $servicos = $em->getRepository('BarbadusBundle:Servico')
                ->findBy(array(), array('nome' => 'ASC'));

        $dtInicio = new \DateTime("+1 day");
        $dtFim = new \DateTime("+1 month");
        $intervalo = new \DateInterval("P1D");
        $periodo = new \DatePeriod($dtInicio, $intervalo, $dtFim);



        return $this->render('BarbadusBundle:Default:index.html.twig', array(
                    'servicos' => $servicos,
                    'datas' => $periodo
        ));
    }

    /**
     * @Route("/profissionais")
     */
    public function profissionaisAction(Request $request) {
        $idServico = $request->get("servico");
        $em = $this->getDoctrine()->getManager();
        $barbeiros = $em->getRepository('BarbadusBundle:Barbeiro')
                ->findBy(array("servico" => $idServico), array('nome' => 'ASC'));

        /* foreach ($barbeiros as $barb)
          {
          $_novo["nome"] = $barb->getNome();
          $novo[] = $_novo;
          } */

        return $this->json($barbeiros);
    }

    /**
     * @Route("/horarios")
     */
    public function horariosAction(Request $request) {
        $barbeiro = $request->get('barbeiro');


        $dtSelecionada = $request->get('dia');

        $pesquisa = $em->createQuery(
                "SELECT a FROM BarbadusBundle:Agendamento a
                WHERE a.barbeiro = :barbeiro
                AND a.horario
                BETWEEN :dtini AND :dtfim"
        );

        $pesquisa->setparamenter('barbeiro', $barbeiro);
        $pesquisa->setparamenter('dtini', $dtSelecionada." 00:00:00");
        $pesquisa->setparamenter('dtfim', $dtSelecionada." 23:59:00");
        
        $resultado = $pesquisa->getResult();
        
        dump($resultado);
        
        $dtInicio = new \DateTime($dtSelecionada);
        $dtInicio->setTime(9, 0, 0);

        $dtFim = new \DateTime($dtSelecionada);
        $dtFim->setTime(18, 0, 0);

        $intervalo = new \DateInterval("PT30M");
        $periodo = new \DatePeriod($dtInicio, $intervalo, $dtFim);

        foreach ($periodo as $dia) {
            $dias['hora'] = $dia->format('H,i');
            $dias['disponivel'] = true;
            $listahorarios[] = $dias;
        }

        return$this->json($listahorarios);
    }

    /**
     * @Route("/agendar")
     */
    public function agendarAction(Request $request) {

        $agendamento = new Agendamento();
        $agendamento->setStatus('NOVO');
        $agendamento->setDataCadastro(new \DateTime());
        $agendamento->setDataAlteracao(new \DateTime());

        $agendamento->setNome($request->get("nome"));
        $agendamento->setTelefone($request->get("telefone"));
        $agendamento->setEmail($request->get("email"));

        $horario = new \DateTime($request->get("horario"));
        $agendamento->setHorario($horario);

        $em = $this->getDoctrine()->getManager();
        $servico = $em->getRepository('BarbadusBundle:Servico')->find($request->get("servico"));
        $barbeiro = $em->getRepository('BarbadusBundle:Barbeiro')->find($request->get("barbeiro"));

        $agendamento->setBarbeiro($barbeiro);
        $agendamento->getServico($servico);

        $em->persist($agendamento);
        $em->flush();

        return $this->render('BarbadusBundle:Default:agendar.html.twig', array(
                    "info" => $agendamento
        ));
    }

}

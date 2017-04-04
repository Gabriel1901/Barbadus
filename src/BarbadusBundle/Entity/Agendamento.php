<?php

namespace BarbadusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="agendamento")
 */
class Agendamento 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Servico")
     * @ORM\JoinColumn(name="servico_id", referencedColumnName="id")
     */
    private $servico;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Barbeiro")
     * @ORM\JoinColumn(name="barbeiro_id", referencedColumnName="id")
     */
    private $barbeiro;
    
    /** 
     * @ORM\Column(type="datetime") 
     */
    private $horario;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;
    
    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telefone;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=TRUE)
     */
    private $email;
    
    /** 
     * @ORM\Column(type="datetime") 
     */
    private $dataCadastro;
    
    /** 
     * @ORM\Column(type="datetime") 
     */
    private $dataAlteracao;
    
    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Status;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set horario
     *
     * @param \DateTime $horario
     *
     * @return Agendamento
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return \DateTime
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Agendamento
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     *
     * @return Agendamento
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Agendamento
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     *
     * @return Agendamento
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    /**
     * Get dataCadastro
     *
     * @return \DateTime
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Set dataAlteracao
     *
     * @param \DateTime $dataAlteracao
     *
     * @return Agendamento
     */
    public function setDataAlteracao($dataAlteracao)
    {
        $this->dataAlteracao = $dataAlteracao;

        return $this;
    }

    /**
     * Get dataAlteracao
     *
     * @return \DateTime
     */
    public function getDataAlteracao()
    {
        return $this->dataAlteracao;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Agendamento
     */
    public function setStatus($status)
    {
        $this->Status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Set servico
     *
     * @param \BarbadusBundle\Entity\Servico $servico
     *
     * @return Agendamento
     */
    public function setServico(\BarbadusBundle\Entity\Servico $servico = null)
    {
        $this->servico = $servico;

        return $this;
    }

    /**
     * Get servico
     *
     * @return \BarbadusBundle\Entity\Servico
     */
    public function getServico()
    {
        return $this->servico;
    }

    /**
     * Set barbeiro
     *
     * @param \BarbadusBundle\Entity\Barbeiro $barbeiro
     *
     * @return Agendamento
     */
    public function setBarbeiro(\BarbadusBundle\Entity\Barbeiro $barbeiro = null)
    {
        $this->barbeiro = $barbeiro;

        return $this;
    }

    /**
     * Get barbeiro
     *
     * @return \BarbadusBundle\Entity\Barbeiro
     */
    public function getBarbeiro()
    {
        return $this->barbeiro;
    }
}

<?php

namespace BarbadusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BarbadusBundle\Entity\Servico;

/**
 * @ORM\Entity
 * @ORM\Table(name="barbeiro")
 */
class Barbeiro 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Servico")
     * @ORM\JoinColumn(name="servico_id", referencedColumnName="id")
     */
    private $servico;
    
    /**
     * @ORM\Column(type="string", length=15, nullable=TRUE)
     */
    private $telefone;
    
    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexo;
    
    /**
     * @ORM\Column(type="date")
     */
    private $dataNascimento;

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
     * Set nome
     *
     * @param string $nome
     *
     * @return Barbeiro
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
     * @return Barbeiro
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
     * Set sexo
     *
     * @param string $sexo
     *
     * @return Barbeiro
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set dataNascimento
     *
     * @param \DateTime $dataNascimento
     *
     * @return Barbeiro
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get dataNascimento
     *
     * @return \DateTime
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set servico
     *
     * @param \BarbadusBundle\Entity\Servico $servico
     *
     * @return Barbeiro
     */
    public function setServico(Servico $servico = null)
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
}

<?php

namespace Api\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tasks
 *
 * @ORM\Table(name="tasks", indexes={@ORM\Index(name="fk_tasks_cards_idx", columns={"cardid"})})
 * @ORM\Entity
 */
class Tasks
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="done", type="boolean", nullable=false)
     */
    private $done = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Api\ApiBundle\Entity\Cards
     *
     * @ORM\ManyToOne(targetEntity="Cards", inversedBy="tasks" )
     * @ORM\JoinColumn(name="cardid", referencedColumnName="id")
     */
    private $cardid;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tasks
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set done
     *
     * @param boolean $done
     *
     * @return Tasks
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return boolean
     */
    public function getDone()
    {
        return $this->done;
    }

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
     * Set cardid
     *
     * @param \Api\ApiBundle\Entity\Cards $cardid
     *
     * @return Tasks
     */
    public function setCardid(\Api\ApiBundle\Entity\Cards $cardid = null)
    {
        $this->cardid = $cardid;

        return $this;
    }

    /**
     * Get cardid
     *
     * @return \Api\ApiBundle\Entity\Cards
     */
    public function getCardid()
    {
        return $this->cardid;
    }

    /**
     * Get tasks
     *
     * @return array
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}

<?php

namespace Api\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cards
 *
 * @ORM\Table(name="cards", indexes={@ORM\Index(name="fk_cards_tasks_idx", columns={"taskid"})})
 * @ORM\Entity
 */
class Cards
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=45, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=30, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=10, nullable=false)
     */
    private $color;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Api\ApiBundle\Entity\Tasks
     *
     * @ORM\ManyToOne(targetEntity="Api\ApiBundle\Entity\Tasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="taskid", referencedColumnName="id")
     * })
     */
    private $taskid;



    /**
     * Set title
     *
     * @param string $title
     *
     * @return Cards
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Cards
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Cards
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Cards
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
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
     * Set taskid
     *
     * @param \Api\ApiBundle\Entity\Tasks $taskid
     *
     * @return Cards
     */
    public function setTaskid(\Api\ApiBundle\Entity\Tasks $taskid = null)
    {
        $this->taskid = $taskid;

        return $this;
    }

    /**
     * Get taskid
     *
     * @return \Api\ApiBundle\Entity\Tasks
     */
    public function getTaskid()
    {
        return $this->taskid;
    }
}
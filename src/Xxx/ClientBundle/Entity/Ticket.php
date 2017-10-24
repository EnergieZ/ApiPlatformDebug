<?php

namespace Xxx\ClientBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="Xxx\ClientBundle\Repository\TicketRepository")
 * @ApiResource(
 *     collectionOperations={
 *         "get"={"method"="GET"},
 *         "post"={"method"="POST"}
 *     },
 *     itemOperations={
 *         "get"={"method"="GET"},
 *         "put"={"method"="PUT"},
 *         "delete"={"method"="DELETE"}
 *     },
 *     attributes={
 *          "normalization_context"={"groups"={"standard"}},
 *          "denormalization_context"={"groups"={"standard_write"}},
 *          "filters"={"ticket.search_filter"}
 *     }
 * )
 */
class Ticket
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"standard","noRelation","detailsProject"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="readed", type="boolean", nullable=true, unique=false)
     * @Groups({"standard","detailsProject", "standard_write"})
     */
    private $readed;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     * @Groups({"standard","noRelation", "standard_write","detailsProject"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", precision=0, scale=0, nullable=false, unique=false)
     * @Groups({"standard","noRelation", "standard_write","detailsProject"})
     */
    private $description;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateAdd", type="datetime", nullable=false, unique=false)
     * @Groups({"standard","noRelation", "standard_write","detailsProject"})
     */
    private $dateAdd;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateEdit", type="datetime", nullable=true, unique=false)
     * @Groups({"standard","noRelation", "standard_write","detailsProject"})
     */
    private $dateEdit;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true, unique=false)
     * @Groups({"standard", "standard_write", "detailsProject"})
     */
    private $priority;

    /**
     * @var \Xxx\ClientBundle\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="Xxx\ClientBundle\Entity\Project", inversedBy="tickets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     * })
     * @Groups({"standard", "standard_write"})
     */
    private $project;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set title
     *
     * @param string $title
     *
     * @return Ticket
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
     * @return Ticket
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
     * Set project
     *
     * @param \Xxx\ClientBundle\Entity\Project $project
     *
     * @return Ticket
     */
    public function setProject(\Xxx\ClientBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Xxx\ClientBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return Ticket
     */
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get dateAdd
     *
     * @return \DateTime
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    /**
     * Set dateEdit
     *
     * @param \DateTime $dateEdit
     *
     * @return Ticket
     */
    public function setDateEdit($dateEdit)
    {
        $this->dateEdit = $dateEdit;

        return $this;
    }

    /**
     * Get dateEdit
     *
     * @return \DateTime
     */
    public function getDateEdit()
    {
        return $this->dateEdit;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return Ticket
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set readed
     *
     * @param boolean $readed
     *
     * @return Ticket
     */
    public function setReaded($readed)
    {
        $this->readed = $readed;

        return $this;
    }

    /**
     * Get readed
     *
     * @return boolean
     */
    public function getReaded()
    {
        return $this->readed;
    }
}

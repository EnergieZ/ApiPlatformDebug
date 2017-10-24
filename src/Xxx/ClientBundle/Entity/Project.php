<?php

namespace Xxx\ClientBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Xxx\ClientBundle\Repository\ProjectRepository")
 * @ApiResource(
 *     collectionOperations={
 *         "get"={"method"="GET", "access_control"="is_granted('ROLE_USER')"},
 *         "post"={"method"="POST", "access_control"="is_granted('ROLE_USER')"}
 *     },
 *     itemOperations={
 *         "get"={"method"="GET", "normalization_context"={"groups"={"detailsProject"}}},
 *         "put"={"method"="PUT"},
 *         "delete"={"method"="DELETE"}
 *     },
 *     attributes={
 *          "normalization_context"={"groups"={"standard"}},
 *          "denormalization_context"={"groups"={"standard_write"}},
 *          "filters"={"project.search_filter"}
 *     }
 * )
 */
class Project
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"standard","detailsProject"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     * @Groups({"standard","detailsProject"})
     */
    private $dateAdd;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     * @Groups({"standard","detailsProject"})
     */
    private $name;

    /**
     * @var \Xxx\ClientBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Xxx\ClientBundle\Entity\User", inversedBy="projects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * })
     * @Groups({"standard"})
     */
    private $customer;

    /**
     * @var \Xxx\ClientBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Xxx\ClientBundle\Entity\User", inversedBy="EAprojects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eateam_user_id", referencedColumnName="id")
     * })
     * @Groups({"detailsProject"})
     */
    private $EAteamUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Xxx\ClientBundle\Entity\Ticket", mappedBy="project")
     * @Groups({"detailsProject"})
     */
    private $tickets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return Project
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
     * Set name
     *
     * @param string $name
     *
     * @return Project
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
     * Set eAteamUser
     *
     * @param \Xxx\ClientBundle\Entity\User $eAteamUser
     *
     * @return Project
     */
    public function setEAteamUser(\Xxx\ClientBundle\Entity\User $eAteamUser = null)
    {
        $this->EAteamUser = $eAteamUser;

        return $this;
    }

    /**
     * Get eAteamUser
     *
     * @return \Xxx\ClientBundle\Entity\User
     */
    public function getEAteamUser()
    {
        return $this->EAteamUser;
    }

    /**
     * Set customer
     *
     * @param \Xxx\ClientBundle\Entity\User $customer
     *
     * @return Project
     */
    public function setCustomer(\Xxx\ClientBundle\Entity\User $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Xxx\ClientBundle\Entity\User
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Add ticket
     *
     * @param \Xxx\ClientBundle\Entity\Ticket $ticket
     *
     * @return Project
     */
    public function addTicket(\Xxx\ClientBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \Xxx\ClientBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\Xxx\ClientBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }
}

<?php

namespace Xxx\ClientBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Xxx\ClientBundle\Repository\UserRepository")
 * @ApiResource(
 *     collectionOperations={
 *         "get"={"method"="GET", "access_control"="is_granted('ROLE_EMPLOYE')"},
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
 *          "filters"={"user.search_filter"}
 *     }
 * )
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"standard"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, precision=0, scale=0, nullable=false, unique=true)
     * @Groups({"standard","standard_write","detailsProject"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=45, precision=0, scale=0, nullable=true, unique=false)
     * @Groups({"standard","standard_write","detailsProject"})
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, precision=0, scale=0, nullable=true, unique=false)
     * @Groups({"standard","standard_write","detailsProject"})
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true, unique=false)
     * @Groups({"standard","standard_write"})
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=45, precision=0, scale=0, nullable=true, unique=false)
     * @Groups({"standard"})
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=15, precision=0, scale=0, nullable=true, unique=false)
     * @Groups({"standard"})
     */
    private $zipCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tenant", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     * @Groups({"standard","standard_write"})
     */
    private $tenant;

    /**
     * @var boolean
     *
     * @ORM\Column(name="owner", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     * @Groups({"standard","standard_write"})
     */
    private $owner;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rent", type="integer", nullable=true, unique=false)
     * @Groups({"standard","standard_write"})
     */
    private $rent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bankConsulted", type="boolean", nullable=true, unique=false)
     * @Groups({"standard","standard_write"})
     */
    private $bankConsulted;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="simple_array", precision=0, scale=0, nullable=true, unique=false)
     * @Groups({"standard"})
     */
    private $roles = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Xxx\ClientBundle\Entity\Project", mappedBy="customer")
     */
    private $projects;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Xxx\ClientBundle\Entity\Project", mappedBy="EAteamUser")
     */
    private $EAprojects;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->EAprojects = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return User
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set tenant
     *
     * @param boolean $tenant
     *
     * @return User
     */
    public function setTenant($tenant)
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * Get tenant
     *
     * @return boolean
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * Set owner
     *
     * @param boolean $owner
     *
     * @return User
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return boolean
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function addRole($role)
    {
        $role = strtoupper($role);
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add project
     *
     * @param \Xxx\ClientBundle\Entity\Project $project
     *
     * @return User
     */
    public function addProject(\Xxx\ClientBundle\Entity\Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \Xxx\ClientBundle\Entity\Project $project
     */
    public function removeProject(\Xxx\ClientBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Add eAproject
     *
     * @param \Xxx\ClientBundle\Entity\Project $eAproject
     *
     * @return User
     */
    public function addEAproject(\Xxx\ClientBundle\Entity\Project $eAproject)
    {
        $this->EAprojects[] = $eAproject;

        return $this;
    }

    /**
     * Remove eAproject
     *
     * @param \Xxx\ClientBundle\Entity\Project $eAproject
     */
    public function removeEAproject(\Xxx\ClientBundle\Entity\Project $eAproject)
    {
        $this->EAprojects->removeElement($eAproject);
    }

    /**
     * Get eAprojects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEAprojects()
    {
        return $this->EAprojects;
    }

    /**
     * Set rent
     *
     * @param integer $rent
     *
     * @return User
     */
    public function setRent($rent)
    {
        $this->rent = $rent;

        return $this;
    }

    /**
     * Get rent
     *
     * @return integer
     */
    public function getRent()
    {
        return $this->rent;
    }

    /**
     * Set bankConsulted
     *
     * @param boolean $bankConsulted
     *
     * @return User
     */
    public function setBankConsulted($bankConsulted)
    {
        $this->bankConsulted = $bankConsulted;

        return $this;
    }

    /**
     * Get bankConsulted
     *
     * @return boolean
     */
    public function getBankConsulted()
    {
        return $this->bankConsulted;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
	
	

    /**
     * Fonctions UserInterface
     */
    public function eraseCredentials()
    {
    }

    public function equals(UserInterface $user)
    {
        return $user->getUsername() === $this->email;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getSalt()
    {
        return '';
    }
}

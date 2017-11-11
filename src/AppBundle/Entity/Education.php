<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Class Education
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @Algolia\Index(autoIndex=false)
 */
class Education
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="education")
     * @ORM\JoinColumn(name="fk_user_id")
     */
    private $user;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $schoolName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return Education
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Education
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSchoolName()
    {
        return $this->schoolName;
    }

    /**
     * @param mixed $schoolName
     * @return Education
     */
    public function setSchoolName($schoolName)
    {
        $this->schoolName = $schoolName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     * @return Education
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     * @return Education
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }
}
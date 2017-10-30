<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\Timestampable;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;

/**
 * Class User
 * @package AppBundle\Entity
 * @author Willem Slaghekke <w.slaghekke@recognize.nl>
 *
 * @ORM\Entity()
 * @Vich\Uploadable()
 */
class User extends BaseUser
{
    use TimestampableEntity;

    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $phoneNumber = '';
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Algolia\Attribute()
     */
    private $firstName = '';
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Algolia\Attribute()
     */
    private $lastName = '';
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(groups={"Profile"})
     * @Algolia\Attribute()
     */
    private $ervaring = '';
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(groups={"Profile"})
     * @Algolia\Attribute()
     */
    private $typeTrainer = '';
    /**
     * @ORM\Column(type="text")
     * @Algolia\Attribute()
     */
    private $motto = '';
    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $geboorteDatum;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Algolia\Attribute()
     */
    private $geslacht = '';
    /**
     * @ORM\Column(type="boolean")
     * @Algolia\Attribute()
     */
    private $vog = false;
    /**
     * @ORM\Column(type="boolean")
     * @Algolia\Attribute()
     */
    private $verified = '';
    /**
     * @ORM\Column(type="string", unique=true)
     * @Gedmo\Slug(fields={"firstName", "lastName"})
     * @Algolia\Attribute()
     */
    private $slug;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $street = '';
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $streetNumber = '';
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $zipcode = '';
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $city = '';
    /**
     * @ORM\Column(type="text", options={"default": ""})
     * @Algolia\Attribute()
     */
    private $description = '';
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Algolia\Attribute()
     */
    private $avatar;
    /**
     * @Vich\UploadableField(mapping="general_image", fileNameProperty="avatar")
     */
    private $avatarFile;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $coverPhoto;
    /**
     * @Vich\UploadableField(mapping="general_image", fileNameProperty="coverPhoto")
     */
    private $coverPhotoFile;
    /**
     * @ORM\Column(type="array")
     * @Algolia\Attribute()
     */
    private $tags;
    /**
     * @ORM\Column(type="array")
     * @Algolia\Attribute()
     */
    private $usps;
    /**
     * @ORM\OneToMany(targetEntity="Training", mappedBy="user")
     */
    private $trainings;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Education", mappedBy="user")
     */
    private $education;

    public function __construct()
    {
        parent::__construct();
        $this->tags = [];
        $this->trainings = new ArrayCollection();
        $this->geboorteDatum = new \DateTime();
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->setUsername($email);

        return $this;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
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
     * Set ervaring
     *
     * @param string $ervaring
     *
     * @return User
     */
    public function setErvaring($ervaring)
    {
        $this->ervaring = $ervaring;

        return $this;
    }

    /**
     * Get ervaring
     *
     * @return string
     */
    public function getErvaring()
    {
        return $this->ervaring;
    }

    /**
     * Set typeTrainer
     *
     * @param string $typeTrainer
     *
     * @return User
     */
    public function setTypeTrainer($typeTrainer)
    {
        $this->typeTrainer = $typeTrainer;

        return $this;
    }

    /**
     * Get typeTrainer
     *
     * @return string
     */
    public function getTypeTrainer()
    {
        return $this->typeTrainer;
    }

    /**
     * Set motto
     *
     * @param string $motto
     *
     * @return User
     */
    public function setMotto($motto)
    {
        $this->motto = $motto;

        return $this;
    }

    /**
     * Get motto
     *
     * @return string
     */
    public function getMotto()
    {
        return $this->motto;
    }

    /**
     * Set geboorteDatum
     *
     * @param string $geboorteDatum
     *
     * @return User
     */
    public function setGeboorteDatum($geboorteDatum)
    {
        $this->geboorteDatum = $geboorteDatum;

        return $this;
    }

    /**
     * Get geboorteDatum
     *
     * @return string
     */
    public function getGeboorteDatum()
    {
        return $this->geboorteDatum;
    }

    /**
     * Set geslacht
     *
     * @param string $geslacht
     *
     * @return User
     */
    public function setGeslacht($geslacht)
    {
        $this->geslacht = $geslacht;

        return $this;
    }

    /**
     * Get geslacht
     *
     * @return string
     */
    public function getGeslacht()
    {
        return $this->geslacht;
    }

    /**
     * Set vog
     *
     * @param string $vog
     *
     * @return User
     */
    public function setVog($vog)
    {
        $this->vog = $vog;

        return $this;
    }

    /**
     * Get vog
     *
     * @return string
     */
    public function getVog()
    {
        return $this->vog;
    }

    /**
     * Set verified
     *
     * @param string $verified
     *
     * @return User
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return string
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return User
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set streetNumber
     *
     * @param string $streetNumber
     *
     * @return User
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return User
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set coverPhoto
     *
     * @param string $coverPhoto
     *
     * @return User
     */
    public function setCoverPhoto($coverPhoto)
    {
        $this->coverPhoto = $coverPhoto;

        return $this;
    }

    /**
     * Get coverPhoto
     *
     * @return string
     */
    public function getCoverPhoto()
    {
        return $this->coverPhoto;
    }

    /**
     * Set tags
     *
     * @param array $tags
     *
     * @return User
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add training
     *
     * @param Training $training
     *
     * @return User
     */
    public function addTraining(Training $training)
    {
        $this->trainings[] = $training;

        return $this;
    }

    /**
     * Remove training
     *
     * @param Training $training
     */
    public function removeTraining(Training $training)
    {
        $this->trainings->removeElement($training);
    }

    /**
     * Get trainings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrainings()
    {
        return $this->trainings;
    }

    /**
     * @return mixed
     */
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    /**
     * @param mixed $avatarFile
     * @return $this
     */
    public function setAvatarFile($avatarFile)
    {
        $this->avatarFile = $avatarFile;

        if ($avatarFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoverPhotoFile()
    {
        return $this->coverPhotoFile;
    }

    /**
     * @param mixed $coverPhotoFile
     * @return $this
     */
    public function setCoverPhotoFile($coverPhotoFile)
    {
        $this->coverPhotoFile = $coverPhotoFile;

        if ($coverPhotoFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @param mixed $education
     */
    public function setEducation($education)
    {
        $this->education = $education;
    }

    /**
     * @return mixed
     */
    public function getUsps()
    {
        return $this->usps;
    }

    /**
     * @param mixed $usps
     * @return User
     */
    public function setUsps($usps)
    {
        $this->usps = $usps;
        return $this;
    }
}

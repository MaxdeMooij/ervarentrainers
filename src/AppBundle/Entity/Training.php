<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;

/**
 * Class Training
 * @package AppBundle\Entity
 * @author Willem Slaghekke <w.slaghekke@recognize.nl>
 *
 * @ORM\Entity()
 * @Vich\Uploadable()
 */
class Training
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     * @Algolia\Attribute
     */
    private $title;
    /**
     * @ORM\Column(type="text")
     * @Algolia\Attribute
     */
    private $description;
    /**
     * @ORM\Column(type="string", unique=true)
     * @Gedmo\Slug(fields={"title"})
     * @Algolia\Attribute
     */
    private $slug;
    /**
     * @ORM\Column(type="array")
     * @Algolia\Attribute
     */
    private $tags;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="trainings")
     * @Algolia\Attribute
     */
    private $user;
    /**
     * @ORM\OneToMany(targetEntity="TrainingPrice", mappedBy="training")
     * @Algolia\Attribute
     */
    private $prices;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Algolia\Attribute
     */
    private $photo;
    /**
     * @Vich\UploadableField(mapping="general_image", fileNameProperty="photo")
     */
    private $photoFile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prices = new ArrayCollection();
    }

    /**
     * @return null
     * @Algolia\Attribute
     */
    public function searchPrice()
    {
        return $this->prices->isEmpty() ? null : (float)$this->prices->first()->getPrice();
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
     * @return Training
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
     * @return Training
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
     * Set tags
     *
     * @param array $tags
     *
     * @return Training
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Training
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add price
     *
     * @param \AppBundle\Entity\TrainingPrice $price
     *
     * @return Training
     */
    public function addPrice(\AppBundle\Entity\TrainingPrice $price)
    {
        $this->prices[] = $price;

        return $this;
    }

    /**
     * Remove price
     *
     * @param \AppBundle\Entity\TrainingPrice $price
     */
    public function removePrice(\AppBundle\Entity\TrainingPrice $price)
    {
        $this->prices->removeElement($price);
    }

    /**
     * Get prices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     * @return Training
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhotoFile()
    {
        return $this->photoFile;
    }

    /**
     * @param mixed $photoFile
     * @return $this
     */
    public function setPhotoFile($photoFile)
    {
        $this->photoFile = $photoFile;

        if ($photoFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

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
     * @return Training
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;

/**
 * Class TrainingPrice
 * @package AppBundle\Entity
 * @author Willem Slaghekke <w.slaghekke@recognize.nl>
 *
 * @ORM\Entity()
 */
class TrainingPrice
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="prices")
     */
    private $training;
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @Algolia\Attribute
     */
    private $type;
    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Algolia\Attribute
     */
    private $price;


    /**
     * Set type
     *
     * @param string $type
     *
     * @return TrainingPrice
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return TrainingPrice
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set training
     *
     * @param \AppBundle\Entity\Training $training
     *
     * @return TrainingPrice
     */
    public function setTraining(\AppBundle\Entity\Training $training)
    {
        $this->training = $training;

        return $this;
    }

    /**
     * Get training
     *
     * @return \AppBundle\Entity\Training
     */
    public function getTraining()
    {
        return $this->training;
    }
}

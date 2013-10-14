<?php

namespace Flexy\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Flexy\DoctrineBehaviorsBundle\Model as FlexyORMBehaviors;

/**
 * Folder
 */
class Folder
{
    use FlexyORMBehaviors\Timestampable\Timestampable;

    /**
     * @var integer
     */
    protected  $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \Flexy\MediaBundle\Entity\Folder
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $medias;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return ($this->name) ?: 'New Folder' ;
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
     * Set name
     *
     * @param string $name
     * @return Media
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Add children
     *
     * @param \Flexy\MediaBundle\Entity\Folder $children
     * @return Folder
     */
    public function addChildren(\Flexy\MediaBundle\Entity\Folder $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Flexy\MediaBundle\Entity\Folder $children
     */
    public function removeChildren(\Flexy\MediaBundle\Entity\Folder $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Flexy\MediaBundle\Entity\Folder $parent
     * @return Folder
     */
    public function setParent(\Flexy\MediaBundle\Entity\Folder $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return \Flexy\MediaBundle\Entity\Folder 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add medias
     *
     * @param \Flexy\MediaBundle\Entity\Media $medias
     * @return Folder
     */
    public function addMedia(\Flexy\MediaBundle\Entity\Media $medias)
    {
        $this->medias[] = $medias;
    
        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Flexy\MediaBundle\Entity\Media $medias
     */
    public function removeMedia(\Flexy\MediaBundle\Entity\Media $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * toArray
     *
     * @return string
     */
    public function toArray()
    {
        $children = array();

        /* @var $child Folder */
        foreach ($this->children as $child) {
            $children[] = $child->toArray();
        }

        return array(
            'key' => $this->id,
            'title' => $this->name,
            'isFolder' => true,
            'children' => $children
        );
    }
}
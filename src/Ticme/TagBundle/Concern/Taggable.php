<?php

namespace Ticme\TagBundle\Concern;


trait Taggable{


    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Ticme\TagBundle\Entity\Tag", cascade="persist")
     */
    private $tags;

    /**
     * Add tag
     *
     * @param \Ticme\TagBundle\Entity\Tag $tag
     *
     * @return Post
     */
    public function addTag(\Ticme\TagBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Ticme\TagBundle\Entity\Tag $tag
     */
    public function removeTag(\Ticme\TagBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
}
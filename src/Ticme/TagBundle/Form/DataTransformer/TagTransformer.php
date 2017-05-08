<?php

namespace Ticme\TagBundle\Form\DataTransformer;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Ticme\TagBundle\Entity\Tag;

class TagTransformer implements DataTransformerInterface{

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function transform($value)
    {
        return implode(',', $value);
    }


    public function reverseTransform($string)
    {
        $names = array_unique(array_filter(array_map('trim', explode(',', $string))));
        $tags = $this->manager->getRepository('TagBundle:Tag')->findBy([
            'title' => $names
        ]);
        $newNames = array_diff($names, $tags);
        foreach ($newNames as $name) {
            $tag = new Tag();
            $tag->setTitle($name);
            $tags[] = $tag;
        }
        return $tags;
    }

}
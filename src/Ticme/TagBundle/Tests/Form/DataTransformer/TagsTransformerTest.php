<?php

namespace Ticme\TagBundle\Tests\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;
use Ticme\TagBundle\Entity\Tag;
use Ticme\TagBundle\Form\DataTransformer\TagTransformer;

class TagsTransformerTest extends TestCase
{
    public function testCreateTagsArrayFromString ()
    {
        $transformer = $this->getMockedTransformer();

        $tags = $transformer->reverseTransform('Chat, Demo');
        $this->assertCount(2, $tags);
    }

    public function testUserAlreadyDefinedTag ()
    {
        $tag = new Tag();
        $tag->setTitle('Chat');

        $transformer = $this->getMockedTransformer([$tag]);

        $tags = $transformer->reverseTransform('Chat, Demo');
        $this->assertCount(2, $tags);
    }

    public function testRemoveEmptyTags()
    {
        $tags = $this->getMockedTransformer()->reverseTransform('Chat, Demo');
        $this->assertCount(2, $tags);
    }

    public function testRemoveDuplicateTags()
    {
        $tags = $this->getMockedTransformer()->reverseTransform('Demo, Demo, Demo');
        $this->assertCount(1, $tags);
    }

    private function getMockedTransformer($result = [])
    {
        $tagRepository = $this->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $tagRepository->expects($this->any())
            ->method('findBy')
            ->will($this->returnValue($result));

        $entityManager = $this->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $entityManager->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($tagRepository));

        return new TagTransformer($entityManager);
    }
}
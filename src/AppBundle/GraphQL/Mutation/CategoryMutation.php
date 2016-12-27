<?php

namespace AppBundle\GraphQL\Mutation;

use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;
use Doctrine\Common\Persistence\ObjectManager;
use JMS\Serializer\Serializer;
use Overblog\GraphQLBundle\Definition\Argument;

class CategoryMutation
{
    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var Serializer */
    private $serializer;

    /** @var ObjectManager */
    private $objectManager;

    public function __construct(ObjectManager $objectManager, CategoryRepository $categoryRepository, Serializer $serializer)
    {
        $this->categoryRepository = $categoryRepository;
        $this->serializer = $serializer;
        $this->objectManager = $objectManager;
    }

    public function mutate(Argument $arg)
    {
        $category = $this->categoryRepository->find($arg['id']);
        if (!$category instanceof Category) {
            return;
        }
        $category->setName($arg['name']);
        $this->objectManager->flush();

        return $this->serializer->toArray($category);
    }
}

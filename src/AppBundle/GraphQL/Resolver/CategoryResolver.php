<?php

namespace AppBundle\GraphQL\Resolver;

use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;
use JMS\Serializer\Serializer;
use Overblog\GraphQLBundle\Definition\Argument;

class CategoryResolver
{
    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var Serializer */
    private $serializer;

    public function __construct(CategoryRepository $categoryRepository, Serializer $serializer)
    {
        $this->categoryRepository = $categoryRepository;
        $this->serializer = $serializer;
    }


    public function resolveCategory(Argument $args)
    {
        $category = $this->categoryRepository->find($args['id']);
        if (!$category instanceof Category) {
            return;
        }

        return $this->serializer->toArray($category);
    }

    public function resolveCategories()
    {
        $categories = $this->categoryRepository->findAll();
        
        return $this->serializer->toArray($categories);
    }
}

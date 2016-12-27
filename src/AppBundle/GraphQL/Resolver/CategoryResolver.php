<?php

namespace AppBundle\GraphQL\Resolver;

use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;
use JMS\Serializer\Serializer;
use Overblog\GraphQLBundle\Definition\Argument;
use RulerZ\RulerZ;

class CategoryResolver extends AbstractResolver
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(Serializer $serializer, RulerZ $rulerZ, CategoryRepository $categoryRepository)
    {
        parent::__construct($serializer, $rulerZ);

        $this->categoryRepository = $categoryRepository;
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

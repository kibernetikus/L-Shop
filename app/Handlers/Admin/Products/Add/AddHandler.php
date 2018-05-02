<?php
declare(strict_types = 1);

namespace App\Handlers\Admin\Products\Add;

use App\DataTransferObjects\Admin\Products\Add\Add;
use App\Entity\Product;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Exceptions\Item\ItemNotFoundException;
use App\Repository\Category\CategoryRepository;
use App\Repository\Item\ItemRepository;
use App\Repository\Product\ProductRepository;

class AddHandler
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(
        ProductRepository $repository,
        ItemRepository $itemRepository,
        CategoryRepository $categoryRepository)
    {
        $this->productRepository = $repository;
        $this->itemRepository = $itemRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Add $dto
     *
     * @throws ItemNotFoundException
     * @throws CategoryNotFoundException
     */
    public function handle(Add $dto): void
    {
        $item = $this->itemRepository->find($dto->getItem());
        if ($item === null) {
            throw ItemNotFoundException::byId($dto->getItem());
        }

        $category = $this->categoryRepository->find($dto->getCategory());
        if ($category === null) {
            throw CategoryNotFoundException::byId($dto->getCategory());
        }

        $product = (new Product($item, $category, $dto->getPrice(), $dto->getStack()))
            ->setSortPriority($dto->getSortPriority())
            ->setHidden($dto->isHidden());
        $this->productRepository->create($product);
    }
}

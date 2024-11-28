<?php

namespace Tests\Unit\UseCase\Category;

use AllowDynamicProperties;
use Core\Domain\Entity\Category;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\DTO\Category\CreateCategory\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CreateCategory\CategoryCreateOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use src\Core\Domain\Repository\CategoryRepositoryInterface;
use stdClass;

#[AllowDynamicProperties] class CreateCategoryUseCaseUnitTest extends TestCase
{
    public function test_create_new_category()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'category_name_A';

        $this->mockEntity = Mockery::mock(
            Category::class,
            [
                $uuid,
                $categoryName,
            ]
        );
        $this->mockEntity->shouldReceive('id')->andReturn($uuid);

        $this->mockRepositoryInterface = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepositoryInterface->shouldReceive('insert')->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(CategoryCreateInputDto::class, [
            $categoryName,
        ]);

        $useCase = new CreateCategoryUseCase($this->mockRepositoryInterface);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryCreateOutputDto::class, $responseUseCase);
        $this->assertEquals($categoryName, $responseUseCase->name);
        $this->assertEquals('', $responseUseCase->description);

        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('insert')->andReturn($this->mockEntity);
        $useCase = new CreateCategoryUseCase($this->spy);
        $responseUseCase = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('insert');

        Mockery::close();
    }
}
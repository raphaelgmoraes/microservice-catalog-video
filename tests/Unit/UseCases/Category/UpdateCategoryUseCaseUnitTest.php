<?php

namespace Tests\Unit\UseCases\Category;

use AllowDynamicProperties;
use Core\Domain\Entity\Category as EntityCategory;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\UpdateCategoryUseCase;
use Core\UseCase\DTO\Category\UpdateCategory\CategoryUpdateInputDto;
use Core\UseCase\DTO\Category\UpdateCategory\CategoryUpdateOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

#[AllowDynamicProperties] class UpdateCategoryUseCaseUnitTest extends TestCase
{
    public function test_rename_category()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'Name';
        $categoryDesc = 'Desc';

        $this->mockEntity = Mockery::mock(
            EntityCategory::class,
            [
                $uuid,
                $categoryName,
                $categoryDesc,
            ]
        );
        $this->mockEntity->shouldReceive('update');
        $this->mockEntity->shouldReceive('createdAt')
            ->andReturn(date('Y-m-d H:i:s'));

        $this->mockRepositoryInterface = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepositoryInterface->shouldReceive('findById')->andReturn($this->mockEntity);
        $this->mockRepositoryInterface->shouldReceive('update')->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(CategoryUpdateInputDto::class, [
            $uuid,
            'name_category',
        ]);

        $useCase = new UpdateCategoryUseCase($this->mockRepositoryInterface);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryUpdateOutputDto::class, $responseUseCase);

        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('findById')
            ->andReturn($this->mockEntity);
        $this->spy->shouldReceive('update')
            ->andReturn($this->mockEntity);
        $useCase = new UpdateCategoryUseCase($this->spy);
        $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('findById');
        $this->spy->shouldHaveReceived('update');

        Mockery::close();
    }
}
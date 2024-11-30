<?php

namespace Tests\Unit\UseCase\Category;

use AllowDynamicProperties;
use Core\Domain\Entity\Category as CategoryEntity;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\ListCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryInputDto;
use Core\UseCase\DTO\Category\CategoryOutupDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

#[AllowDynamicProperties] class ListCategoryUseCaseUnitTest extends TestCase
{
    public function test_get_by_id()
    {
        $id = (string) Uuid::uuid4()->toString();

        $this->mockEntity = Mockery::mock(CategoryEntity::class, [
            $id,
            'test_category',
        ]);
        $this->mockEntity->shouldReceive('id')->andReturn($id);
        $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $this->mockRepositoryInterface = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepositoryInterface->shouldReceive('findById')
            ->with($id)
            ->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(CategoryInputDto::class, [$id]);

        $useCase = new ListCategoryUseCase($this->mockRepositoryInterface);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryOutupDto::class, $response);
        $this->assertEquals('test_category', $response->name);
        $this->assertEquals($id, $response->id);

        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('findById')
            ->with($id)
            ->andReturn($this->mockEntity);
        $useCase = new ListCategoryUseCase($this->spy);
        $response = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('findById');
    }

    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }
}

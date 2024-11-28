<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Throwable;

class CategoryUnitTest extends TestCase
{
    protected const CATEGORY_NAME = 'category_name';
    protected const NOTES = 'notes';

    public function test_attributes()
    {
        $category = new Category(
            name: self::CATEGORY_NAME,
            description: self::NOTES,
            isActive: true
        );
        $this->assertNotEmpty($category->id());
        $this->assertEquals(self::CATEGORY_NAME, $category->name);
        $this->assertEquals(self::NOTES, $category->description);
        $this->assertEquals(true, $category->isActive);
        $this->assertNotEmpty($category->createdAt());
    }

    public function test_activated()
    {
        $category = new Category(
            name: self::CATEGORY_NAME,
            isActive: false,
        );

        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function test_disabled()
    {
        $category = new Category(
            name: self::CATEGORY_NAME,
        );

        $this->assertTrue($category->isActive);
        $category->disable();
        $this->assertFalse($category->isActive);
    }

    public function test_update()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $category = new Category(
            id: $uuid,
            name: self::CATEGORY_NAME,
            description: self::NOTES,
            isActive: true,
            createdAt: date('Y-m-d H:i:s')
        );

        $category->update(
            name: 'new_category_name',
            description: 'new_notes',
        );

        $this->assertEquals($uuid, $category->id());
        $this->assertEquals('new_category_name', $category->name);
        $this->assertEquals('new_notes', $category->description);
    }

    public function test_exception_name()
    {
        try {
            new Category(
                name: 'aa',
                description: self::NOTES,
            );

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testExceptionDescription()
    {
        try {
            new Category(
                name: self::CATEGORY_NAME,
                description: random_bytes(999999)
            );

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}
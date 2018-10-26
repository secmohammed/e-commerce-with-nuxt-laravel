<?php

namespace Tests\Feature\Categories;

use App\Categories\Domain\Models\Category;
use App\Categories\Domain\Resources\CategoryResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryIndexTest extends TestCase
{
    /** @test */
    public function it_returns_a_collection_of_a_categories()
    {
       $categories = factory(Category::class,2)->create();
       $response = $this->get('/api/categories');
       $categories->each(function($category) use($response){
            $response->assertJsonFragment([
                'slug' => $category->slug
            ]);
       });
    }
    /** @test */
    public function it_returns_only_parent_category()
    {
        $category = factory(Category::class)->create();
        $category->children()->save(
            factory(Category::class)->create()
        );
        $this->get('/api/categories')
        ->assertJsonCount(1 , 'data');
    }
    /** @test */
    public function it_returns_categories_ordered_by_their_given_order()
    {
        $category = factory(Category::class)->create([
            'order' => 2
        ]);
        $anotherCategory = factory(Category::class)->create([
            'order' => 1
        ]);
        $this->get('/api/categories')
        ->assertSeeInOrder([
            $anotherCategory->slug , $category->slug
        ]);
        
    }
}

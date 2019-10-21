<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_administrator_can_access_the_admin_section()
    {
        $this->signInAdmin();
        $this->get(route('admin.dashboard.index'))
             ->assertStatus(Response::HTTP_OK);
    }
    
    /** @test */
    public function non_administrator_can_not_access_the_admin_section()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $this->get('/admin')
             ->assertStatus(Response::HTTP_FORBIDDEN);
    }
    
    /** @test */
    public function an_admin_can_create_sellers()
    {
        //$admin = factory('App\User')->state('administrator')->create();
        //$this->actingAs($admin);
        $this->signInAdmin();
        
        $seller = create('App\Seller');
        //dd($seller);
        $response = $this->post(route('admin.sellers.store'), $seller->toArray());
        //$this->assertDatabaseHas('sellers', ['name' => $seller->name]);
        $this->get($response->headers->get('Location'))
             ->assertSee($seller->name);
    }
    
    /** @test */
    public function a_seller_requires_name()
    {
        $this->withExceptionHandling();
        $response = $this->createSeller(['name' => null]);
        $response->assertSessionHasErrors('name');
    }
    
    /** @test */
    public function a_seller_requires_description()
    {
        $this->withExceptionHandling();
        $response = $this->createSeller(['name'=>'wow','description' => null]);
        $response->assertSessionHasErrors('description');
    }
    
    
    public function createSeller($overrides = [])
    {
        $this->signInAdmin();
        $seller = make('App\Seller', $overrides);
        return $this->post(route('admin.sellers.store'), $seller->toArray());
    }
    
    
}

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
        $this->signInAdmin();
        $seller = make('App\Seller',['name' => '6FL']);
        $response = $this->post('/admin/sellers', $seller->toArray());
        //$this->assertDatabaseHas('sellers', ['name' => $seller->name]);
        //dd($response->headers);
        $this->get($response->headers->get('Location'))
             ->assertSee('6FL');
    }
    
    
    
    
}

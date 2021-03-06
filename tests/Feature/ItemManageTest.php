<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemManageTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function user_can_add_items()
    {

        $this->signInAdmin();
        $item = create('App\Item');
        //dd($item);
        $this->post('/items/', $item->toArray());
        $this->assertDatabaseHas('items',['id' =>  $item->id]);

    }

    /** @test */
    public function items_in_a_box_can_be_deleted()
    {
        $box = create('App\Box');
        $item = create('App\Item', ['box_id' => $box->id]);
        //dd($box->path());

        $this->json('Delete', $box->path() . '/' . $item->id);
        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }

    /** @test */
    public function unauth_user_can_not_delete_items()
    {
        $this->withExceptionHandling();
        $item = create('App\Item');
        $this->delete("/items/{$item->id}")
             ->assertRedirect('/login');
    }

    /** @test */
    public function auth_user_can_delete_items()
    {
        $this->signIn();
        $item = create('App\Item', ['user_id' => auth()->id()]);
        $this->delete("/items/{$item->id}")
             ->assertStatus(302);
    }

    /** @test */
    public function users_can_fetch_associated_items_in_a_box()
    {
        $box = create('App\Box');
        create('App\Item',['box_id'=>$box->id],2);
        $response = $this->getJson($box->path().'/items')->json();
        //dd($response);
        $this->assertCount(2, $response['data']);
        $this->assertEquals(2, $response['total']);
    }

    /** @test */
    public function auth_user_can_delete_items_in_a_box()
    {
        $this->signIn();
        $box = create('App\Box');
        $item = create('App\Item',['box_id'=>$box->id]);
        $response = $this->delete("/boxes/{$box->seller->name}/{$box->slug}/{$item->id}");
        //dd($response);
        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }



}

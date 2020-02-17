<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Symfony\Component\Routing\Tests\Fixtures\AnnotationFixtures\Utf8ActionControllers;
use Tests\TestCase;

class SlugTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_make_korean_slug()
    {
        $this->signInAdmin();
        $name = '김창만';
        $seller = create('App\Seller',[
            'name'=>$name,
            'slug' => $this->make_slug($name),
            'description'=>'6층'
        ]);
        $this->post(route('admin.sellers.store'), $seller->toArray());
        $this->assertDatabaseHas('sellers', ['slug' => '김창만']);
    }

    public function make_slug($string)
    {
        //$string = iconv('UTF-8', 'UTF-8', $string);

        return $slug = preg_replace('/\s+/u','_', trim($string));
        //$name = iconv('UTF-8', 'ASCII', $name);
        //dd($name);
        //$slug = Str::slug( $name, '-');
        //dd($string); // "김창만"
        //$slug = Str::slug($string, '-');
        //$name = iconv('ascii', 'UTF-8', $slug);
        //dd($slug);
        //return Str::slug($slug);
    }


}

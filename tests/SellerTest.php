<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

class SellerTest extends TestCase
{
	public function testShowWithJson()
	{
		$seller = factory('App\Seller')->create();
		$supposed = App\Seller::with('category')->where('id', $seller->id)->first()->toArray();
		
		$this->get('/seller/show/'.$seller->id, array('Content-Type' => 'application/json'))
			->seeJsonEquals($supposed);
			
	}
	
	public function testIndexWithJson()
	{
		$supposed = App\Seller::with('category')->get();
		$supposed = collect($supposed)->toArray();
		
		$this->get('/seller/index', array('Content-Type' => 'application/json'))
			->seeJsonEquals($supposed);
	}
	
	public function testSellerDeleteOk()
	{
		$seller = factory('App\Seller')->create();
		
		$this->visit('/seller/delete/'.$seller->id)
			->notSeeInDatabase('sellers', [
				'id' => $seller->id
			]);
			
	}
	
	public function testSellerCreateOk()
	{
		$faker = Faker::create();
		
		$name = $faker->name;
		$category = App\Category::orderByRaw('RAND()')->first();
		$category_id = $category->id;
		$address = $faker->address;
		$phone = $faker->phoneNumber;
		$email = $faker->email;
		
		$this->visit('/seller/index')
			->click('New Seller')
			->seePageIs('/seller/create')
			->see('name')
			->see('_token')
			->type($name, 'name')
			->see('category')
			->see('categories', App\Category::all())
			->select($category_id, 'category')
			->see('address')
			->type($address, 'address')
			->see('phone')
			->type($phone, 'phone')
			->see('email')
			->type($email, 'email')
			->see('Create')
			->press('Create')
			->seeInDatabase('sellers', [
				'name' => $name
			]);
	}
	
    public function testSellerIndexIsOk()
    {
        $actual = App\Seller::with('category')->get();
		
		$this->visit('/seller/index')	
			->assertViewHas('sellers', $actual);
    }
}

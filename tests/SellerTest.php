<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

class SellerTest extends TestCase
{
	
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
			->see('Seller')
			->assertViewHas('sellers', $actual);
    }
}

<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SellerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSellerIndexIsOk()
    {
        $actual = App\Seller::with('category')->get();
		
		$this->visit('/seller/index')
			->see('Seller')
			->assertViewHas('sellers', $actual);
    }
}

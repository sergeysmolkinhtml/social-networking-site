<?php

namespace Tests\Unit;

use App\Services\CheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');

    }

    /**
     * A basic unit test example.
     */
    public function test_checkout(): void
    {
        $pricing_rules = [
          'CF1' => ['get_one_free',null,null],
          'SR1' => ['bulk_discount', 3, 4.50]

        ];


       $co = new CheckoutService($pricing_rules);
       $co->scan('FR1');
       $co->scan('SR1');
       $co->scan('FR1');
       $co->scan('FR1');
       $co->scan('CF1');
       $this->assertEquals(22.45, $co->total);
    }
}

<?php

namespace Tests\Unit;


use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class FirstTest extends TestCase
{
    public function test_example(): void
    {
        Cache::shouldReceive('get')
            ->with('ky')
            ->andReturn('value');

        $response = $this->get('/cache');

        $response->assertSee('value');
    }
}
<?php

namespace Tests\Feature;

class HealthcheckTest extends TestCase
{
    /** @test */
    public function canPingHealthcheck()
    {//triggering ci
        $this->get('/healthcheck/'.env('HEALTHCHECK_TOKEN'))
            ->assertResponseOk();
    }
}

<?php

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ExpirationTest extends TestCase
{
    public function testWillExpireAt()
    {
        $created_at = Carbon::now()->subDays(2);
        $due_time = Carbon::now()->addDays(3);

        $expected = $due_time->format('Y-m-d H:i:s');
        $actual = Expiration::willExpireAt($due_time, $created_at);

        $this->assertEquals($expected, $actual);
    }
}

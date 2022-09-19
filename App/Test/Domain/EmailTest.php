<?php 

use App\Domain\User\Email;
use PHPUnit\Framework\TestCase;
use App\Domain\Exceptions\EmailException;

class EmailTest extends TestCase
{
    public function test_email_invalid()
    {
        $this->expectException(EmailException::class);
        new Email("invalid");
    }

    public function test_email_valid()
    {
        $email = new Email("thomas@gmail.com");
        $this->assertEquals("thomas@gmail.com", $email);
    }
}
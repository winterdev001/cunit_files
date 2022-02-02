<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;

class MailerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_sending()
    {
        Mail::fake();

        Mail::send(new MyTestMail());
 
        // Mail::assertSent(MyTestMail::class);
 
        Mail::assertSent(MyTestMail::class, function ($mail) {
            // $mail->build();
            $this->assertTrue($mail->hasTo('snowdevin.sd@gmail.com'));
            // $this->assertTrue($mail->hasFrom('admin@gmail.com'));
            // $this->assertTrue($mail->hasSubject('Mail from Winterdev'));
            // $this->assertTrue($mail->hasCc('hola@mailtrap.io'));
 
            // return true;
        });
    }
}

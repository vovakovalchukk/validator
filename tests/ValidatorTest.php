<?php 

require __DIR__ . '/../src/Validation.php';

use PHPUnit\Framework\TestCase;

final class ValidationTest extends TestCase
{

    public function testTextNotEmpty(): void
    {
        $validation = new Validation();
        $validation->name('text')->value('text')->required();
        $this->assertEmpty($validation->getErrors());
        $this->assertTrue($validation->isSuccess());
    }

    public function testTextEmpty(): void
    {
        $validation = new Validation();
        $validation->name('text')->value('')->required();
        $this->assertNotEmpty($validation->getErrors());
        $this->assertTrue(in_array('Заполните поле: text', $validation->getErrors()));
        $this->assertTrue(!$validation->isSuccess());
    }

    public function testEmailValid(): void
    {
        $validation = new Validation();
        $validation->name('email')->value('test@email.ru')->pattern('email')->required();
        $this->assertEmpty($validation->getErrors());
        $this->assertTrue($validation->isSuccess());
    }

    public function testEmailNotValid(): void
    {
        $validation = new Validation();
        $validation->name('email')->value('testemail.ru')->pattern('email')->required();
        $this->assertTrue(in_array('Ошибка валидации: email', $validation->getErrors()));
        $this->assertNotEmpty($validation->getErrors());
        $this->assertTrue(!$validation->isSuccess());
    }

    public function testUrlValid(): void
    {
        $validation = new Validation();
        $validation->name('url')->value('http://address.ru')->pattern('url')->required();
        $this->assertEmpty($validation->getErrors());
        $this->assertTrue($validation->isSuccess());
    }

    public function testUrlNotValid(): void
    {
        $validation = new Validation();
        $validation->name('url')->value('address')->pattern('url')->required();
        $this->assertTrue(in_array('Ошибка валидации: url', $validation->getErrors()));
        $this->assertNotEmpty($validation->getErrors());
        $this->assertTrue(!$validation->isSuccess());
    }

    public function testForm(): void
    {
        $validation = new Validation();
        $text = 'text';
        $email = 'mail@mail.ru';
        $url = 'http://url.ru';
        $validation->name('text')->value($text)->required();
        $validation->name('email')->value($email)->pattern('email')->required();
        $validation->name('url')->value($url)->pattern('url')->required();

        $this->assertEmpty($validation->getErrors());
        $this->assertTrue($validation->isSuccess());

    }
}

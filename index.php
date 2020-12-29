<?php require 'src/Validation.php' ?>

<form method="POST">
	<input name="text" value="<?=isset($_POST['text']) ? $_POST['text'] : 'text'?>">
	<input name="url" value="<?=isset($_POST['url']) ? $_POST['url'] : 'http://url.ru'?>">
	<input name="email" value="<?=isset($_POST['email']) ? $_POST['email'] : 'email@mail.ru'?>">
    <select multiple class="form-control" name="multiple">
        <option value="1">option 1</option>
        <option value="2">option 2</option> 
        <option value="3">option 3</option>
        <option value="4">option 4</option>
        <option value="5">option 5</option>
    </select>
    <input name="custom" value="<?=isset($_POST['custom']) ? $_POST['custom'] : 'custom'?>">
	<input type="submit" name="submit"/>
</form>

<?php

if(isset($_POST['submit']))
{
	$val = new Validation();
    $val->name('text')->value($_POST['text'])->required();
    $val->name('email')->value($_POST['email'])->pattern('email')->required();
    $val->name('url')->value($_POST['url'])->pattern('url')->required();
    $val->name('multiple')->value($_POST['multiple'])->required();
    $val->name('custom')->value($_POST['custom'])->message('Только числа')->customPattern('[0-9]+')->required();

    if(!$val->isSuccess())
    {
        foreach($val->getErrors() as $err)
        {
        	echo $err . '<br/>';
        }
    }
}
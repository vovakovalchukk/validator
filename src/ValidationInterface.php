<?php

interface ValidationInterface {
	public function pattern($name);
	public function customPattern($pattern);
}
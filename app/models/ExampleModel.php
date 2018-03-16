<?php // Agradeço a Deus pelo dom do conhecimento

namespace App\Models;

class ExampleModel
{
	private $title;

	public function __construct($title)
	{
		$this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function __toString()
	{
		return $this->title;
	}
}

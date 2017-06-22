<?php

namespace App\Presenters;

use Nette;
use App\Model;
use App\Forms;


class HomepagePresenter extends BasePresenter
{

	/** @var Forms\ContactFormFactory @inject */
	public $contactFormFactory;

	/** @var Forms\ParserFormFactory @inject */
	public $parserFormFactory;


	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

	protected function createComponentContactForm()
	{
		$form =  $this->contactFormFactory->create(function () {});
		return $form;
	}

	protected function createComponentParserForm()
	{
		$form =  $this->parserFormFactory->create(function () {});
		return $form;
	}

	

}

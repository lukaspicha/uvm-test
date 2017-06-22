<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;

use App\Model;


class ParserFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;


	private $parserModel;

	public function __construct(FormFactory $factory, Model\ParserModel $parserModel)
	{
		$this->factory = $factory;
		$this->parserModel = $parserModel;
	}

	/**
	 * @return Form
	 */
	public function create(callable $onSuccess)
	{
		$form = $this->factory->create();
		
		$form->addUpload("file", "Název souboru:");

		$form->addSubmit("send", "Upload")
			->onClick[] = [$this, "upload"];

		
		return $form;
	}

	
	public function upload($button)
	{
		$form = $button->getForm();
		$values = $form->getValues();
		try
		{
			$this->parserModel->parseXML($values->file);
			$form->parent->flashMessage("XML bylo importováno.", "ui green message");

		}
		catch(\PDOException $ex)
		{
			$form->parent->flashMessage($ex->getMessage(), "ui red message");
		}
		$form->parent->redirect("this");
	}
}

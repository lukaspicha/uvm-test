<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;

use App\Model;

use Nette\Mail\Message;
use Nette\Mail\SendMailer;


class ContactFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;


	private $demandModel;

	public function __construct(FormFactory $factory, Model\DemandModel $demandModel)
	{
		$this->factory = $factory;
		$this->demandModel = $demandModel;
	}

	/**
	 * @return Form
	 */
	public function create(callable $onSuccess)
	{
		$form = $this->factory->create();
		
		$form->addText("name", "Jméno:")
			->setAttribute("placeholder", "jméno")
			->setRequired("Zadej jméno");


		$form->addText("surname", "Příjmení:")
			->setAttribute("placeholder", "příjmení");

		$form->addText("mail", "E-mailová adresa:")
			->setAttribute("placeholder", "e-mailová adresa");

		$form->addText("phone", "Telefonní číslo:")
			->setAttribute("placeholder", "telefonní číslo");

		$form->addTextArea("desc", "Poznámka:")
			->setAttribute("placeholder", "poznámka");

		$form->addSubmit("send", "Odeslat poptávku")
			->onClick[] = [$this, "sendDemand"];

		$form->onValidate[] = [$this, "validateForm"];

		return $form;
	}

	public function validateForm($form)
	{
		$values = $form->getValues();
		if(!$values->name)
			$form->addError("Zadejte své jméno.");

		if(!$values->name)
			$form->addError("Zadejte své příjmení.");

		if(!(is_numeric($values->phone)))
			$form->addError("Telefonní číslo obsahuje neplatné znaky.");
		if(strlen($values->phone) != 9)
			$form->addError("Telefon nemá délku 9 znaků.");

		preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $values->mail, $matches, PREG_OFFSET_CAPTURE);
		if(count($matches) == 0)
			$form->addError("Neplatný formát e-mailu.");

		if(!$values->desc)
          $form->addError("Vyplňte pole poznámka.");
	
	}

	public function sendDemand($button)
	{
		$form = $button->getForm();
		$values = $form->getValues();
		try
		{
			
			$this->demandModel->addRow($values);
			//$this->writeMail($values);
			$form->parent->flashMessage("Poptávka byla odeslána.", "ui green message");

		}
		catch(\PDOException $ex)
		{
			$form->parent->flashMessage($ex->getMessage(), "ui red message");
		}
		$form->parent->redirect("this");
	}

	private function writeMail($values)
	{
		$latte = new \Latte\Engine;
		$mail = new Message;
		$mailer = new Nette\Mail\SmtpMailer(["host" => "127.0.0.1"]);
		$mail->setFrom("picha@uvm.cz")
			->setSubject("Nová poptávka od UVM (Pícha)")
			->setHtmlBody($latte->renderToString($this->context->parameters["appDir"]."/presenters/templates/Homepage/newdemandmail.latte", $values));

		$mail->addTo($client);
		$mailer->send($mail);
	}

}

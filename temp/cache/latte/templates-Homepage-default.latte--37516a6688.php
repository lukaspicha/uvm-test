<?php
// source: C:\xampp\htdocs\picha\app\presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Template37516a6688 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
?>


<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
	<div class="ui segment">
		
		<?php
		/* line 6 */
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["contactForm"], ['class' => "ui form"]);
?>

			<h2 class="ui dividing header">Nová poptávka</h2>
			
			<div class="two fields">
				<div class="field">
					<?php if ($_label = end($this->global->formsStack)["name"]->getLabel()) echo $_label ?>

					<?php echo end($this->global->formsStack)["name"]->getControl() /* line 12 */ ?>

				</div>
				<div class="field">
					<?php if ($_label = end($this->global->formsStack)["surname"]->getLabel()) echo $_label ?>

					<?php echo end($this->global->formsStack)["surname"]->getControl() /* line 16 */ ?>

				</div>
			</div>
			<div class="two fields">
				<div class="field">
					<?php if ($_label = end($this->global->formsStack)["mail"]->getLabel()) echo $_label ?>

					<?php echo end($this->global->formsStack)["mail"]->getControl() /* line 22 */ ?>

				</div>
				<div class="field">
					<?php if ($_label = end($this->global->formsStack)["phone"]->getLabel()) echo $_label ?>

					<?php echo end($this->global->formsStack)["phone"]->getControl() /* line 26 */ ?>

				</div>
			</div>
			<div class "ui field">
				<?php if ($_label = end($this->global->formsStack)["desc"]->getLabel()) echo $_label ?>

				<?php echo end($this->global->formsStack)["desc"]->getControl() /* line 31 */ ?>

			</div>
			<div class="ui divider"></div>
			<div class="ui field">
				<?php echo end($this->global->formsStack)["send"]->getControl()->addAttributes(['class' => "ui teal button"]) /* line 35 */ ?>

			</div>
	<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>

	</div>

	<div class="ui segment">
		<?php
		/* line 41 */
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["parserForm"], ['class' => "ui form"]);
?>

			<h2 class="ui dividing header">Import xml</h2>
			<div class "ui field">
				<?php if ($_label = end($this->global->formsStack)["file"]->getLabel()) echo $_label ?>

				<?php echo end($this->global->formsStack)["file"]->getControl() /* line 45 */ ?>

			</div>
			<div class="ui divider"></div>
			<div class="ui field">
				<?php echo end($this->global->formsStack)["send"]->getControl()->addAttributes(['class' => "ui teal button"]) /* line 49 */ ?>

			</div>
		<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>

	</div>

<?php
	}

}

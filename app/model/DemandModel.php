<?php

namespace App\Model;

use Nette;

class DemandModel extends BaseModel
{
	

	public function __construct(Nette\Database\Context $database) 
    {
    	$this->tableName = "demands";
		parent::__construct($database, $this->tableName);
    }

}
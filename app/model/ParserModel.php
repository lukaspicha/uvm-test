<?php

namespace App\Model;

use Nette;

class ParserModel extends BaseModel
{
	

	public function __construct(Nette\Database\Context $database) 
    {
    	$this->tableName = "books";
		parent::__construct($database, $this->tableName);
    }

    public function parseXML($file)
    {
    	$xmlDoc = new \DOMDocument();
    	$xmlDoc->load($file);
    	$searchNode = $xmlDoc->getElementsByTagName("book");
    	foreach ($searchNode as $node) {
    		$values = ["id" => $node->getAttribute("id"), 
    			"author" => $node->getElementsByTagName("author")->item(0)->nodeValue,
    			"title" => $node->getElementsByTagName("title")->item(0)->nodeValue,
    			"genre" => $node->getElementsByTagName("genre")->item(0)->nodeValue,
    			"price" => $node->getElementsByTagName("price")->item(0)->nodeValue,
    			"publish_date" => $node->getElementsByTagName("publish_date")->item(0)->nodeValue,
    			"description" => $node->getElementsByTagName("description")->item(0)->nodeValue
    		];
    		$this->addRow($values);
    		
    	}

    }

}
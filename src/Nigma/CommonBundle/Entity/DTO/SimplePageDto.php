<?php

namespace Nigma\CommonBundle\Entity\DTO;

use Nigma\CommonBundle\Entity\Page;
use JsonSerializable;

class SimplePageDto implements JsonSerializable {

    const ID = 'id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const KEYWORDS = 'keywords';
    const IMAGE = 'image';
    const CONTENT = 'content';
    const NAME = 'name';
    const SECTION = 'section';

    private $data;

    public function __construct($page) {
        $this->data = array(
            self::ID => $page->getId(),
            self::TITLE => $page->getTitle(),
            self::DESCRIPTION => $page->getDescription(),
            self::KEYWORDS => $page->getKeywords(),
            self::IMAGE => $page->getImage(),
            self::NAME => $page->getName(),
            self::SECTION => $page->getSection()
        );
    }
    
    public function getData(){
        return $this->data;
    }
    
    function jsonSerialize() {
        return $this->data;
    }

}

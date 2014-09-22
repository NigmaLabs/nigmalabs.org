<?php

namespace Nigma\CommonBundle\Entity\DTO;

use Nigma\CommonBundle\Document\Page;
use JsonSerializable;

class SimplePageListDto implements JsonSerializable {

    private $data;

    public function __construct($pages) {
        $this->data = [];
        foreach($pages as $page){
            $dto = new SimplePageDto($page);
            $this->data[] = $dto->getData();
        }
    }
    
    public function getData(){
        return $this->data;
    }
    
    function jsonSerialize() {
        return $this->data;
    }

}

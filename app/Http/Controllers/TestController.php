<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

interface DeveloperSay {
    public function recommend();
}

class JavaDeveloperSay implements DeveloperSay {
    public function recommend() {
        return "I am a Java Developer!";
    }
}

class PHPDeveloperSay implements DeveloperSay {
    public function recommend() {
        return "I am a PHP Developer!";
    }
}

class DeveloperService {
    protected $developerSay;
    public function __construct(DeveloperSay $input)
    {
        $this->developerSay = $input;
    }
    public function introduce() {
       return $this->developerSay->recommend();
    }
}

class TestController {
    private $developerService;
    // public function __construct(DeveloperService $input)
    // {
    //     $this->developerService = $input;
    // }

    public function test() {

        $this->developerService = new DeveloperService(new PHPDeveloperSay());
        echo  $this->developerService->introduce();
    }
}

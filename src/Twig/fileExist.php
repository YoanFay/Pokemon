<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class fileExist extends AbstractExtension
{
    public function getFilters(): array
    {

        return [
            new TwigFilter('fileExist', [$this, 'fileExist']),
        ];
    }


    public function getFunctions(): array
    {

        return [
            new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }


    public function fileExist($url)
    {

        $headers = @get_headers($url);


        if ($headers && strpos($headers[0], '200 OK') !== false) {
            return true;
        }

        return false;
    }
}

<?php
namespace App\Http;

interface RequestInterface
{
     public function getMethod();
     public function getUrl();
}
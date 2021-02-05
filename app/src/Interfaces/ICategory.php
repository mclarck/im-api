<?php
namespace App\Interfaces;

interface ICategory{
    function getName();
    function setName(?string $value);
    function getValue();
    function setValue(?string $value);
}
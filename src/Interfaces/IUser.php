<?php

namespace App\Interfaces;

interface IUser
{
    function setPassword(string $password);
    function getPassword();
    function setApiKey(?string $api);
    function getApiKey();
}

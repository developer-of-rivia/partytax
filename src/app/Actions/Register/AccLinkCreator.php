<?php
namespace App\Actions\Register;

class AccLinkCreator
{
    public function handle()
    {
        return fake()->password();
    }
}
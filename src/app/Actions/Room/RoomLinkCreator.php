<?php
namespace App\Actions\Room;

class RoomLinkCreator
{
    public function handle()
    {
        return fake()->password();
    }
}
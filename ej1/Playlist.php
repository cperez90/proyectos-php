<?php

class Playlist
{
    public $name;
    public $songs;

    public function  __construct($name, $songs)
    {
        $this->name = $name;
        $this->songs = $songs;
    }

    public function shuffle()
    {
        shuffle($this->songs);
    }

}


/*$playlists = [];

$playlists[] = new Playlist('80s Headbangers', [
    'Back in Black',
    'Are You Ready',
    'Hells Bells',
    'Highway to Hell'
]);

$playlists[0]->shuffle();

die(var_dump($playlists));*/
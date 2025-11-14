<?php

class Playlist
{
    public function  __construct(public $name,public array $songs)
    {

    }

}

class Song
{
    public function __construct(public string $name, public string $artist)
    {

    }
}

$songs = [
    new Song('My Hearts Will Go On', 'Celine Dion'),
    false,
    'adasaadasd',
    null
];

$playlist = new Playlist('80s Headbangers', $songs);

foreach ($playlist->songs as $song) {
    echo  $song->artist;
}
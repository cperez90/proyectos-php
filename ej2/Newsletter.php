<?php

class User
{

}

Class Newsletter
{
    public function __construct(public NewsletterProvider $provider)
    {

    }
    public function subscribe(User $user)
    {
        $this->provider->addToList('default',$user->email);

        $user->update(['subscrideb' => true]);

        return true;
    }
}

interface NewsletterProvider
{
    public function addToList(string $list, string $email): void;
}

class CampaignMonitorProvider implements NewsletterProvider
{
    public function addToList(string $list, string $email): void
    {
        $cm = new CampaignMonitorApi();

        $cm->addApiKey('asdfasdfdas');

        $list = $cm->lists->find($list);

        $list->addToList($email);
    }
}

$newsletter = new Newsletter(
    new CampaignMonitorProvider()
);

$newsletter->subscribe(new User);
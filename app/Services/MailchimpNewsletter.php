<?php

namespace App\Services;

use \MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    public function __construct(protected ApiClient $client)
    {
    }

    public function subscribe(string $emailAddress, string $listId = null)
    {
        $listId ??= config("services.mailchimp.lists.subscribers");

        return $this->client->lists->addListMember($listId, [
            "email_address" => $emailAddress,
            "status" => "subscribed",
        ]);
    }
}

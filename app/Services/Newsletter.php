<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function __construct(protected ApiClinet $clinet)
    {
        
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');
        
        return $this->clinet->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

  
}

<?php
namespace App\Services;

use MailchimpMarketing\ApiClient;

class ConvertKitNewsletter implements Newsletter
{
  
	/**
	 * @param string $email
	 * @param string|null $list
	 * @return mixed
	 */
	public function subscribe(string $email, string $list = null) {
    // subscribe the user with the convert-kit specific
    // API Requests.
	}
}
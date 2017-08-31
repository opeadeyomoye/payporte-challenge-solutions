<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/31/17
 * Time: 10:18 AM
 */

/*
 | Get all phone numbers
 |
 | GET https://telco.org/api/phoneNumbers
 |
 */
function all_phone_numbers()
{
    return $this->response->json($this->Numbers->all());
}

/*
 | Get phone numbers of a single customer
 |
 | GET https://telco.org/api/customers/{customerId}/phoneNumbers
 |
 */
function single_customer_numbers($customerId)
{
    return $this->response->json(
        $this->Numbers
            ->find('all')
            ->where(['Numbers.customer_id' => $customerId])
            ->toArray()
    );
}

/*
 | Activate a phone number.
 |
 | POST https://telco.org/api/phoneNumbers/{phoneNumber}/activate
 |
 */
function activate_phone_number($phoneNumber)
{
    return $this->response->json(
        $this->Numbers
            ->update()
            ->set(['Numbers.activated' => 1])
            ->where(['Numbers.number' => $phoneNumber]) // phone number is, ideally, a unique key in the db
            ->execute()
    );
}

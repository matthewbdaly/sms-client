<?php

namespace Matthewbdaly\SMS\Contracts;

interface Driver
{
    /**
     * Get driver name
     *
     * @return string
     */
    public function getDriver();

    /**
     * Get endpoint URL
     *
     * @return string
     */
    public function getEndpoint();

    /**
     * Send the SMS
     *
     * @param array $message An array containing the message.
     * @return boolean
     */
    public function sendRequest(array $message);
}

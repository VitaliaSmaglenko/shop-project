<?php
namespace Sender;

interface TransportInterface
{
    public function createTransport($config);
}
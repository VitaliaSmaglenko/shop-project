<?php
/**
 * Interface TransportInterface
 */
namespace Sender;

interface TransportInterface
{
    /**
     * @param $config
     * @return mixed
     */
    public function createTransport($config);
}
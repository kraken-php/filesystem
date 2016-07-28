<?php

namespace Kraken\Filesystem\Factory;

use Dropbox\Client;
use League\Flysystem\AdapterInterface;
use League\Flysystem\Dropbox\DropboxAdapter;
use Kraken\Filesystem\FilesystemAdapterSimpleFactory;
use Kraken\Util\Factory\SimpleFactoryInterface;

class DropboxFactory extends FilesystemAdapterSimpleFactory implements SimpleFactoryInterface
{
    /**
     * @return mixed[]
     */
    protected function getDefaults()
    {
        return [];
    }

    /**
     * @return string
     */
    protected function getClient()
    {
        return Client::class;
    }

    /**
     * @return string
     */
    protected function getClass()
    {
        return DropboxAdapter::class;
    }

    /**
     * @param mixed[] $config
     * @return AdapterInterface
     */
    protected function onCreate($config = [])
    {
        $client = $this->getClient();
        $class  = $this->getClass();

        $client = new $client(
            $this->param($config, 'accessToken'),
            $this->param($config, 'appSecret')
        );

        return new $class(
            $client,
            $this->param($config, 'prefix')
        );
    }
}

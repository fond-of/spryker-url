<?php

namespace FondOfSpryker\Yves\Url\Model;

interface UrlPrefixHandlerInterface
{
    /**
     * @return string
     */
    public function getUrlPathPrefix(string $locale): string;
}

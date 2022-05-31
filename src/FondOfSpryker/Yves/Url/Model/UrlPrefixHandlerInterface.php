<?php

namespace FondOfSpryker\Yves\Url\Model;

interface UrlPrefixHandlerInterface
{
    /**
     * @param string $locale
     *
     * @return string
     */
    public function getUrlPathPrefix(string $locale): string;
}

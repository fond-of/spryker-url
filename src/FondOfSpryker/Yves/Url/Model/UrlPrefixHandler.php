<?php

namespace FondOfSpryker\Yves\Url\Model;

class UrlPrefixHandler implements UrlPrefixHandlerInterface
{
    /**
     * @return string
     */
    public function getUrlPathPrefix(string $locale): string
    {
        return mb_substr($locale, 0, 2);
    }
}

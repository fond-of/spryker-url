# fond-of-spryker/url
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/url)

## Install

```
composer require fond-of-spryker/url
```

## Optional
### Configuration
If you need the url prefix in template

Register UrlPathPrefixTwigPlugin in TwigDependencyProvider

```
protected function getTwigPlugins(): array
    {
        return [
            ...
            new UrlPathPrefixTwigPlugin(),
        ];
    }
```

### Usage
Use in template
```
{{ url_path_prefix }}
```

## Changelog
20200311 - moved the stuff from the old deprecated ShopApplicationServiceProvider addGlobalTemplateVariables to the twig UrlPathPrefixTwigPlugin

# fond-of-spryker/url
[![CI](https://github.com/fond-of/spryker-url/actions/workflows/main.yml/badge.svg)](https://github.com/fond-of/spryker-url/actions/workflows/main.yml)
[![license](https://img.shields.io/github/license/fond-of/spryker-url.svg)](https://packagist.org/packages/fond-of/spryker-url)

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

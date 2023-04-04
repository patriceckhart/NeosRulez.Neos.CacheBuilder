# Frontend cache builder for Neos CMS.

A Neos CMS package that warms up the frontend caches.

## Installation

Just run:

```
composer require neosrulez/neos-cachebuilder
```

## Configuration

```yaml
NeosRulez:
  Neos:
    CacheBuilder:
      sitemaps:
        - https://acme.com/sitemap.xml

```

## Usage

Run it when you start your instance or run it as a cron job:

```
flow cache:build
```
or
```
flow cache:build --sitemap https://acme.com/sitemap.xml
```
to use a specific sitemap

## Author

* E-Mail: mail@patriceckhart.com
* URL: http://www.patriceckhart.com 

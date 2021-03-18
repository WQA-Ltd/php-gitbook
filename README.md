# Gitbook API wrapper for PHP

Note that The GitBook API is still in beta, so the underlying API and this wrapper are subject to change.

# Install

`composer require wqa/php-gitbook`

# Usage

## Create a client

```php
$gitbook = new GitbookClient($secretKey);
```

## Get the current user

```php
$gitbook->getCurrentUser();
```

## Get user

```php
$gitbook->getUser($userUid);
```

## Get spaces for current user

```php
$gitbook->getSpaces();
```

## Get spaces for specific user or organisation

```php
$gitbook->getSpacesFor($userUid);
$gitbook->getSpacesFor($organisationUid);
```

## Get space

```php
$gitbook->space($spaceUid)->get();
```

## Get space revision

```php
$gitbook->space($spaceUid)->primaryRevision()->get();
$gitbook->space($spaceUid)->revision($revisionUid)->get();
```

## Get space draft revision

```php
$gitbook->space($spaceUid)->draft($draftUid)->get();
```

## Get space variant

```php
$gitbook->space($spaceUid)->primaryRevision()->getVariant();
$gitbook->space($spaceUid)->primaryRevision()->getVariant('spanish');
```

## Get page content

```php
$gitbook->space($spaceUid)->primaryRevision()->getPage($pageUid);
$gitbook->space($spaceUid)->primaryRevision()->getPageByUrl($pageUrl);

// Get page content for variant
$gitbook->space($spaceUid)->primaryRevision()->getPage($pageUid, 'spanish');
$gitbook->space($spaceUid)->primaryRevision()->getPageByUrl($pageUrl, 'spanish');

// Get page content as markdown
$gitbook->space($spaceUid)->primaryRevision()->getPage($pageUid, 'master', PageFormat::Markdown);
$gitbook->space($spaceUid)->primaryRevision()->getPageByUrl($pageUrl, 'master', PageFormat::Markdown);
```

## Get space assets

```php
$gitbook->space($spaceUid)->primaryRevision()->getAssets();
```

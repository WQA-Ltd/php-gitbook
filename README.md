# Gitbook API wrapper for PHP

Note that The GitBook API is still in beta, so the underlying API and this wrapper are subject to change.

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

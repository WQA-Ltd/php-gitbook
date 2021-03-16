# Gitbook API wrapper for PHP

Note that The GitBook API is still in beta, so the underlying API and this wrapper are subject to change.

# Features
- ✅ Authentication
- ✅ Current user
- ⬜️ Current user organisations
- ⬜️ Get User
- ⬜️ Get Organization
- ⬜️ List Current User Spaces
- ⬜️ List User or Organization Spaces
- ⬜️ Get Space
- ⬜️ Get Space Content Analytics
- ⬜️ Get Space Search Analytics


# Usage

## Create a client

```php
$gitbook = new GitbookClient($secretKey);
```

## Get the current user

```php
$gitbook->getCurrentUser();
```

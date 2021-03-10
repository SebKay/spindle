# Slim Starter

An easy to use [Slim 4](https://www.slimframework.com/) starter project for server side apps.

![Test PHP](https://github.com/SebKay/slim-starter/workflows/Test%20PHP/badge.svg)

## What's Included

- Database models via [Eloquent](https://laravel.com/docs/8.x/eloquent)
- Dependency Injection via a container
- CSRF protection
- Twig for templating
- VueJS for reactivity
- Sass for styling
- CSS autoprefixing

## Why

- Single instance app makes building and testing easy.
- No hunting around fragmented include files trying to figure out what's going on.
- Using [Laravel's](https://laravel.com/) ORM, [Eloquent](https://laravel.com/docs/8.x/eloquent), makes working with the database a breeze.
- Easily add services to the container by extending the base `App\Container\Service` class.

## How

### New Project

```shell
composer create-project sebkay/slim-starter project-name
```

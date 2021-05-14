# Spindle

An easy to use [Slim 4](https://www.slimframework.com/) starter project for server side apps.

[![Test PHP](https://github.com/SebKay/spindle/actions/workflows/test-php.yml/badge.svg)](https://github.com/SebKay/spindle/actions/workflows/test-php.yml)

## What's Included

- [Eloquent](https://laravel.com/docs/8.x/eloquent) database models
- Dependency Injection via a container
- CSRF protection (via [Slim CSRF](https://github.com/slimphp/Slim-Csrf))
- [Twig 3](https://twig.symfony.com/) for templating
- [Vue.js 3](https://v3.vuejs.org/) for reactivity and single file components
- [Sass](https://sass-lang.com/) for styling
- CSS autoprefixing (via [autoprefixer]())
- [Webpack 5](https://webpack.js.org/) for compiling

## Why

- A single instance app makes building and testing easy.
- No hunting around fragmented include files trying to figure out what's going on.
- Using [Laravel's](https://laravel.com/) ORM, [Eloquent](https://laravel.com/docs/8.x/eloquent), makes working with the database a straightforward.
- Easily add services to the container by extending the base `App\Container\Service` class.

## How

### New Project

```shell
composer create-project sebkay/spindle project-name
```

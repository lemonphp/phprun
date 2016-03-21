Introduction
===
[![Build Status](https://travis-ci.org/lemonphp/phprun.svg?branch=master)](https://travis-ci.org/lemonphp/phprun)
[![Coverage Status](https://coveralls.io/repos/github/lemonphp/phprun/badge.svg?branch=master)](https://coveralls.io/github/lemonphp/phprun?branch=master)

A a simple command line application framework to develop simple tools based on Symfony2 components

Main features
---
- [ ] Support PHP ^5.5.9
- [ ] Support Dependency Injection
- [ ] Support Event dispatcher
- [ ] Support log output to file
- [ ] Support output task durations
- [ ] Support load tasks from file
- [ ] Support task dependencies

Requirements
---

* php >=5.5.9
* pimple/pimple ^3.0
* symfony/console ^3.0
* symfony/event-dispatcher ^3.0

Installation
---

```shell
$ composer require --dev lemonphp/phprun
```

Usage
---
Make file `phprun.php` in root directory of project.

```php
<?php
// file /path/to/project/phprun.php
namespace Lemon\PHPRun;

task('abc', function($input, $output, $env) {
    echo 'abc';
});
```

After that, run with your shell:
```shell
$ cd /path/to/project
$ ./vendor/bin/phprun
```

Changelog
---
See [CHANGELOG.md][changelog]

Contributing
---
All code contributions must go through a pull request and approved by
a core developer before being merged. This is to ensure proper review of all the code.

Fork the project, create a feature branch, and send a pull request.

To ensure a consistent code base, you should make sure the code follows the [PSR-2][psr2].

If you would like to help take a look at the [list of issues][issues].

License
---
This project is released under the MIT License.
Copyright © 2015-2016 LemonPHP Team.


[changelog]: https://github.com/lemonphp/phprun/blob/master/CHANGELOG.md
[psr2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[issues]: https://github.com/lemonphp/phprun/issues
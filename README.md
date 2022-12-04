# Slim template

## MAke commands

````shell
$ make help

➜  slim-template git:(improvement/create-template-slim) ✗ make help
Usage: make [target] ...

Container:
  run                 Build and run php container
  build               Build php container
  stop                Stop php container
  destroy             Remove all data related with php container
  php-shell           SHH in container
  nginx-shell         SHH in container
  logs                Show logs in container

Tests:
  test                Execute tests
  test-coverage       Execute tests with coverage
  test-integration    Execute integration-tests, check access to localhost

Style:
  lint                Show style errors
  lint-fix            Fix style errors

Code:
  exec                Execute the code index

Library:
  start               Init library rename strings

Miscellaneous:
  help                Show this help

Written by Antonio Miguel Morillo Chica, version v1.0
Please report any bug or error to the author.

````
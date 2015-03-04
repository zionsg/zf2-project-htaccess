## ZF2 Project .htaccess

Modified .htaccess and index.php for Zend Framework 2 (ZF2) projects. This allows the accessing of the project via `http://example.com/project` instead of `http://example.com/project/public` when setting up a virtual host to point to the `public` directory is not possible, eg. the project is on shared hosting with no access to the Apache config.

Referring to the Zend Skeleton Application (https://github.com/zendframework/ZendSkeletonApplication) directory structure, the .htaccess and index.php in this repository should be placed in the main project folder while the .htaccess and index.php in the public/ subfolder should be deleted.

```
http://example.com/skeleton
  [config]
  [data]
  [module]
  [public]
    [css]
    [fonts]
    [img]
    [js]
  [vendor]
  .htaccess
  index.php
  init_autoloader.php
```

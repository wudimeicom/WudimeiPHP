### WudimeiPHP
a php 7 development framework created by wudimei.com

more infomation please see the "test" folder
the "test" folder can be deleted for saving disk space.

## Installation:

1. please download wudimeiPHP https://github.com/wudimeicom/WudimeiPHP/archive/master.zip
2. unzip it and move to a directory you want, rename the folder to "WudimeiPHP"
3. require the autoload.php
3. use namespance of the specified class you need
for example:

```php
<?php
// test.php
require_once __DIR__ .'/WudimeiPHP/autoload.php';

use Wudimei\Registry;
Registry::set("name",'yqr');
echo Registry::get("name");
?>
```

## Documentation
please see [doc/][1]
## Licence:

The MIT License (MIT)

[1]: doc/index.md

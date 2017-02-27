# karriere legacy

## bootstrapping
place this after `session_start` and before helper usage:
```php
\Karriere\Legacy\Bootstrap::initialize();
```

## session

### get session instance
```php
session();
```

### get session value
```php
session($key);
session($key, $defaultValue);
```

### store in session
```php
session(['key' => 'value']);
```

### add flash message
```php
session()->flash($key, $value);
```

## redirects

### send redirect
```php
redirect($url, $statuscode)->send();

### redirect with flash message
```php
redirect($url, $statusCode)->with($key, $value)->send();
```
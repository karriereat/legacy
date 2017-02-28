<a href="https://www.karriere.at/" target="_blank"><img width="200" src="http://www.karriere.at/images/layout/katlogo.svg"></a>
<span>&nbsp;&nbsp;&nbsp;</span>
[![StyleCI](https://styleci.io/repos/83349380/shield?branch=master)](https://styleci.io/repos/83349380)

# Legacy Helpers
This package contains some convenient helper functions inspired by laravel helpers that can be used in a legacy application without a container.
## Installation
You can install the package via composer

```
composer require karriere/legacy
```

## Bootstrapping
Place the `initialize` call after `session_start` and before helper usage:
```php
\Karriere\Legacy\Bootstrap::initialize();
```

## Available Helpers
### die dump
Dumps an arbitrary variable/value and stops execution of the script.
```php
dd('any value');
dd($_GET);
```

### session
Helper method for php session operations. 
#### get session instance
```php
session();
```
Returns an instance of `Karriere\Legacy\Session`.

#### get session value
Retrieve a value from the session, the call allows a second parameter that is returned as default value if no 
session data is found for the eky
```php
session('key');
session('key', 'no data');
```

#### store data in session
Store the given key-value pair in the session.
```php
session(['key' => 'value']);
```

### add flash message
Store a key-value pair only for the subsequent request. 
```php
session()->flash($key, $value);
```

### Redirect
Helper method for sending redirects.
#### send redirect
The method allows a second parameter for status code, the default value is 302 (Found - Moved Temporarily).
```php
redirect('http://www.karriere.at')->send();
redirect('http://www.karriere.at', 301)->send();
```

#### redirect with flash message
The redirector allows to store flash messages before sending the actual redirect.
```php
redirect('http://www.karriere.at')->with('status', 'something happened')->send();
```

## License

Apache License 2.0 Please see [LICENSE](LICENSE) for more information.

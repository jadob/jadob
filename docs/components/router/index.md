# jadob/router

Provides URL Routing and generating. 

## Configuration Reference

### Config node name
`router`

### Config options
- `case_sensitive` - boolean 
- `force_https` - boolean - ignores `$_SERVER['HTTPS']` presence and forces router to generate all paths with HTTPS protocol.
- `routes` - Route[] - array of Routes and Route Collections.
- `context` - array - sets fixed context for router:
  - `host` - string - hostname of your webpage.
  - `port` - int - port number
  - `base_url` - string - full base URL where your page lives. *(Overrides values from `host` and `port` options)*

When `context` is passed to config, values from superglobals are ignored.
  
 
  

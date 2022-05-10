## Backbone Assessment
<b>Warning: This is a complex way to solve the problem. For a simple one, check the `simpler` branch.</b>

This solution considers multiple providers, one of these, being database but considering backbone api as a providers and allowing extension

A `place` service has been created. This services returns location data provided a zip code.
The data source can be defined via a config `place.provider`. Possible providers are `database`, `backbone` and `fake`. The `fake` providers is meant for testing purposes.

The service structures the data in a way that is easily consumed by the resources that use them.

The controller only responsibility is to instance the service, obtain the location, pass it to the a resource and return said resource.

The resource and inner resources are responsible for creating the json structure required.

Almost all in new classes was tested. 

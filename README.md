## Backbone Assessment
<b>Warning: This is a simple way to solve the problem. For a more complex one, check the `master` branch.</b>

This solution considers database as the source of data.

An implicit binding was used to instance a record based on a zip code.
In order to magically work the getRouteKeyName has been modified in zipCode model.

Similar to the complex approach, the controller only takes the zip code, gives it to the resource for this to create the right structure
and returns said resource.

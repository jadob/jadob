# Accessing matched route information

Where to find information about which route has been matched during request?
There are some places where you can find your Route object:


## In controllers

You can define ``Jadob\Router\Route`` as one of your action argument, dispatcher will assign a currently matched route
to them.

## From RequestContext

When you have access to ``Jadob\Core\RequestContext`` object in your scope, call ``getRoute`` method to get ``Jadob\Router\Route``
object.

## From Request

After route matched, a dispatcher will put Route into request attributes:

You can find current path name in ``path_name`` attribute:

``$request->attributes->get('path_name');``

You can find the whole Route object in ``current_route`` attribute:

``$request->attributes->get('current_route');``





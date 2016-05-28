UniqueLibs/RequestToQueryBuilderBundle
=============

The RequestToQueryBuilderBundle by UniqueLibs adds support to operate search and order by filters to a doctrine query builder.

Features include:

- Sort Query Builder (?sort=product.name)
- SQL Search Filter in URL (?query=WHERE product.name = 'Product Name')
- Complex search queries (WHERE (product.name = 'Product Name' AND product.id = 2) OR product.id = 1)
- Specify allowed properties (only allow order on product.id)
- Symfony 3.0 Support
- PHP 7.0 Support

This Bundle is in alpha state and not ready for prod usage.

Documentation coming soon.

[![Build Status](https://api.travis-ci.org/UniqueLibs/request-to-query-builder-bundle.png?branch=master)](https://travis-ci.org/UniqueLibs/request-to-query-builder-bundle)

About
-----

EmberDataSerializerBundle is a [UniqueLibs](https://github.com/UniqueLibs) initiative.
See also the list of [contributors](https://github.com/UniqueLibs/request-to-query-builder-bundle/contributors).

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/UniqueLibs/request-to-query-builder-bundle/issues).

When reporting a bug, it may be a good idea to reproduce it in a basic project
built using the [Symfony Standard Edition](https://github.com/symfony/symfony-standard)
to allow developers of the bundle to reproduce the issue by simply cloning it
and following some steps.
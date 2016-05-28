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
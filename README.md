# Umber HTTP

A series of light weight abstractions around crafting HTTP responses.

|Master|Develop|
|---|---|
|[![Build Status](https://travis-ci.com/umber/http.svg?branch=master)](https://travis-ci.com/umber/http)|[![Build Status](https://travis-ci.com/umber/http.svg?branch=develop)](https://travis-ci.com/umber/http)

## Installation

The package can be installed through composer through [Packagist](https://packagist.org/packages/umber/http):

* `composer require umber/http`

Please anchor the version to `2.x` as version `1.x` is not supported anymore.

## Usage

A HTTP response is represented by an implementation of `HttpResponseInterface`.
These classes implement basic concepts of a HTTP response and can be used to compile a valid response for use OR can be converted to your framework of choice.

The following classes are at its core:

* `Umber\Http\Header\HttpHeaderInterface`
* `Umber\Http\Response\HttResponseInterface`

Basic implementations of these classes exist:

* `Umber\Http\Header\HttpHeader`
* `Umber\Http\Response\HttpResponse`
* `Umber\Http\Response\Type\JsonHttpResponse`

Currently the only format this package supports out of the box is `json`.
This is not a design limitation but because the package was originally designed with an API focus.
For working with `json` the following classes are available:

* `Umber\Http\Factory\Type\JsonHttpResponseFactoryInterface`
* `Umber\Http\Factory\Type\JsonHttpResponseFactory`
* `Umber\Http\Factory\Type\JsonHttpResponseGenerator`
* `Umber\Http\Response\Type\JsonHttpResponse`

Abstractions around the following API concepts are also implemented:

* `Serialization`
* `Pagination`

### Serialization

For requests that are used in API context you may want to invoke a serializer.
This package does not provide a serialization implementation but an abstraction to interact with one of your choice.

A `HttpResponseInterface` tailored for serialization is provided:

* `Umber\Http\Serializer\Response\SerializerHttpResponse`

This response requires an instance of `HttpResponseSerializerInterface` is provided along with any serialization groups.
The data given to the response is the raw data to be serialized.
When the response is used to get the body it will serialize the data at that point.

**NOTE**, when using `JsonHttpResponseGenerator` with a `HttpResponseSerializerInterface` provided it will automatically construct these `SerializerHttpResponse` classes for you.

Serialization is done just in time and therefore will not be represented as a performance hit within your controllers.
This is done so that responses can be intercepted and changed without wasting compute on serializing data that is not needed.

### Pagination

For requests that are used in API context you may want to invoke a paginator.
This package does not provide a pagination implementation but an abstraction to interact with one of your choice.

A `HttpResponseInterface` should not accept a paginator as it's data.
However a `PaginatiorAwareHttpResponseInterface` will.

Because of this the following responses are available (and should be used as example for adding other types):

* `Umber\Http\Response\Type\JsonPaginatorHttpResponse`

Responses that are paginator aware should make use of the `PagiantorResponseHelper` and follow the example of the `JsonPaginatorHttpResponse`.
These responses will initialise 4 new headers when the paginator is invoked.

* `Pagination-Results-Per-Page`
* `Pagination-Results-Count`
* `Pagination-Results-Total`
* `Pagination-Pages-Total`

Paginator aware responses should be automatically constructed when given to the `*Factory` of your choice.
As the `*Generator` will often use the `*Factory` this class also accepts paginator's.
For example giving a paginator to the `JsonHttpResponseFactory` (or `JsonHttpResponseGenerator`) will return a `JsonPaginatorHttpResponse`.

## Frameworks

Currently I have a bundle for Symfony that defines all the classes as services.
Controllers are allowed to return instances of `HttpResponseInterface` and they will be transformed in to Symfony `Request` objects.

Simply use the following bundle:

* `Umber\Http\Framewor\Symfony\UmberHttpBundle`

The configuration is optional, but to define a serializer implementation use the following methods to provide link to the service you wish to use.

```yaml
umber_http:
  serializer: 'service.definition.reference.here'
```

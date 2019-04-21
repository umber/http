# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2019-04

This repository is now no longer managed by the (private) mono repository and will now be handled independently.
The project has also gone through a re-write and is now focusing at being an abstraction around HTTP instead of an implementation.
Code will be provided to integrate with common Framework.

## [1.2.0] - 2019-01-30

This is the first changelog entry.

### Exception Hinting

The two exception hints have been migrated from the `umber/common` package as they are more relevant here.
Because of this the following exception hints are available:

* `Umber\Http\Hint\HttpCanonicalAwareExceptionInterface`
* `Umber\Http\Hint\HttpAwareExceptionInterface`

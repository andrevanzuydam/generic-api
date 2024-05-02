# Generic Api

This Tina4 module is designed to provide a simple api with limited coding, taking advantage of the Tina4 ORM. The ORM
class names are used as the api endpoint names. The Api comes with built in security and env configuration.

## Installation

`composer require justblink/generic-api` This will also install Tina4 as a dependency.

Initialize Tina 4

`composer exec tina4 initialize:run`

## Setup

Please add the following to the .env file and set as desired

*Adds to the url between domain name and generic-api routes*

`JB_GAPI_BASE_URL=`

## Simple endpoints

All ORM objects should have a primary key `id`.

Get all rows - GET `/[class name]`

Get one row - GET `/[class name]/{id}`

Insert a row - POST `/[class name]`

Update a row - POST `/[class name]/{id}`

Delete a row - DELETE `/[class name/{id}`

## Class names

Class names should be supplied lower case. Complex class names should be separated by "-".

For example:
`/my-class-name` will resolve to `MyClassName` in the ORM.

## Validation

Adding a JbGapiValidation attribute to the ORM will invoke the built in validation. For example this will check if firstName
is a string.

```
#[JbGapiValidation('string')]
public firstName;
```

By extending the ValidationHelper one can write the extraValidate() function to do custom or extend existing validation. 
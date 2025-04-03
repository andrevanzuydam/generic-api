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

`GENERIC_API_BASE_URL=`

## Security

All endpoints are protected with the Tina4 `@secure` route protection. However please ensure that you have added security
to your satisfaction.

## Simple endpoints

All ORM objects should have a primary key `id`.

All endpoints can be extended with a prefix set in the .env file by setting the flag GENERIC_API_BASE_URL

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

Adding a GenericApiValidation attribute to the ORM will invoke the built in validation. For example this will check if 
firstName is a string.

```
#[GenericApiValidation('string')]
public firstName;
```

By extending the ValidationHelper one can write custom validations or manipulate values before or after the normal validations, 
by using the beforeValidate() and afterValidate() functions. Each one has the ability to return if the validation was correct, 
the value as is (including manipulations), and an error message if required.

## Testing

There is a simple test application built around generic-api and can be found at CrisHigham/generic-api-example. This was built as the base for a postman testing suite and can be used as a base project at your own risk.
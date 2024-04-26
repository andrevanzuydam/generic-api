# Generic Api

This Tina4 module is designed to provide a simple api with limited coding, taking advantage of the Tina4 ORM. The ORM
class names are used as the api endpoint names. The Api comes with built in security and env configuration.

## Installation

`composer require justblink/generic-api`

## Setup

Please add the following to the .env file.

`JB_GAPI_BASE_URL=` *Default = ''*

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
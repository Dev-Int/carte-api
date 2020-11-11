# Carte-API
An API for a restaurant menu and recall notebook.

![Carte-API](https://github.com/Dev-Int/carte-api/workflows/Carte-API/badge.svg)

## Features

- Load the list of dishes and menus of a restaurant, to distribute it on a website, 
so that customers can consult it without touching a document. [See more...](./doc/carte.md)

- Scan a QR-code to access the restaurant's recall book, as part of health recommendations, due to COVID-19. [See more...](./doc/recall-book.md)
 
## Install

After download or clone the source code, update your database data connect in `.env` file.
```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
```

Then run the follow command to create database, and configure the application : 

```
make install
```

This application is made with Symfony 5, and first with MySQL (reflexion for PostgreSQL).

## Extras

If you want to see the entities declaration (with the phpStorm plugin `PlantUML`) : [Entities.puml](doc/data/Entities.puml)

The [TODO](./doc/todo.md) file is synchronised with [github issues](https://github.com/Dev-Int/carte-api/issues).

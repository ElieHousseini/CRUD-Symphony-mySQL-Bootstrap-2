# CRUD-Symphony-mySQL-Bootstrap-2

_It's a Blog Web App, User can create an account, Post an article, write a comment_

## 🎬 LIVE DEMO

_available soon_

## 📖 Table of content

- Screenshots
- Usage
- Technologies used
- Requirements
- Installation
- Useful commands
- Note
- Contributing
- License

## 📷 Screenshots

![Demo1](screenshot/Capture.PNG)
![Demo2](screenshot/Capture1.PNG)
![Demo3](screenshot/Capture2.PNG)

## ⚙️ Usage

CRUD-Symphony-mySQL-Bootstrap-2 can be used as backbone for a big  
project that includes fetching Data from mySQL Database or any type of relational Databases.

## ⚙️ Technologies used

- Symfony Framework (PHP)
- Javascript
- CSS
- HTML
- Bootstrap

## ⚙️ Requirements

- Terminal (i.e: [Hyper](https://hyper.is/))
- Code Editor (i.e: [VScode](https://code.visualstudio.com/download))
- Browser (i.e: [Chrome](https://www.google.com/chrome/))
- Apache distribution (i.: [XAMPP](https://www.apachefriends.org/index.html))
- Stable internet Connection

## 📌 Installation

Before starting, it's required to have Symphony Framework installed.  
Click [here](https://symfony.com/doc/current/setup.html) for a step by step guide to install Symfony Framework on your PC.

## 💡 Useful Commands

1- Creating a Symfony project:

```bash
composer create-project symfony/website-sekeleton project1
```

2- Running the project on your local machine:

```bash
composer require server --dev
symfony server:start
```

3- Creating a Controller:

```bash
php bin/console make:controller
```

4- Creating a new Database using Doctrine

```bash
php bin/console doctrine:database:create
```

5- Creating entities in Database

```bash
php bin/console make:entity
```

6- Migrating SQL from the entities

```bash
php bin/console make: migration
php bin/console doctrine:migrations:migrate
```

7- Adding Faker

```bash
- composer require orm-fixtures --dev
- php bin/console make:fixtures
```

8- Adding the fake data from AppFixtures to the Database

```bash
php bin/console doctrine:fixture:load
```

9- Generating a Form using CLI

```bash
php bin/console make:form
```

10- Migrate by force

```bash
php bin/console doctrine:schema:update --force
```

## 📍 Note

In case you got stuck at any point, checkout the official  
documentation of [Symfony](https://symfony.com/doc/current/index.html).  
I will try to explain everything you need to know as comments in each file.

## Contributing

Pull requests are welcome. For major changes, please open  
 an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)

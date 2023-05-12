# Symfony-TeamProjects

For our projects

## Using the image

## Installation

```shell
git clone Symfony-TeamProjects
cd Symfony-TeamProjects
cp .env.example .env && cp web/.env.example web/.env
docker-compose up --build
```

## Setup

Create new symfony app in root

```shell
symfony new web
```

in root .env:

```code
DATABASE_NAME=teamDB
```

in web .env:

```code
DATABASE_URL="mysql://root:lionPass@db:3306/teamDB?serverVersion=5.7"
```

- Symfony 6 will run on [http://localhost:8008](http://localhost:8007)
- phpMyAdmin will run on [http://localhost:9083](http://localhost:9082)

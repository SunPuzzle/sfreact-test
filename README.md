# Demo: Symfony + Docker + API Platform + React Typescript 


## Getting Started

1. [Run docker containers](./docs/README.md). Before it check net ports and env
2. Install node packages with `$ yarn install`
3. Connect docker container `$ docker exec -it phpcontainerid /bin/sh`
4. Check php dependencies, if not installed run `composer intall`
3. Run migrations `$ php bin/console doctrine:migrations:migrate`
4. Fill table with random data `$ php bin/console gen-ideas 100000`

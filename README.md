create own env file and update

```bash
cp .env .env.local
```

run docker compose with your env

```bash
docker-compose --env-file ./.env.local up --build -d
```

or run with your docker-compose file

```bash
docker-compose --env-file .env.local -f docker-compose-dev.yml -f docker-compose.yml up --build -d
```

after build container you can start/stop your container

```bash
docker-compose start
```

or

````bash
docker-compose stop
````
app shell
```bash
docker-compose exec app sh
```

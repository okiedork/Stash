# Test scenario

How to test:

- run `docker-compose up --build` to start the containers.
  - check the output of the php service: `Cache miss.` (twice).
- run `docker-compose exec redis redis-cli` to access the Redis server.
- set a password on the Redis server: `ACL SETUSER default >123abc`
- open another terminal and restart the php service: `docker-compose restart php`
  - check the output of the php service: `Caught exception: NOAUTH Authentication required.` (twice).
- destroy everything `docker-compose down`

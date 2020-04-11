#### Prepare migration after docker building:
```
docker-compose exec php bin/console doctrine:migrations:migrate
```

### Jwt Auth problems
```
- generate new key:
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

- edit passphrase in .env

- doc:
https://medium.com/@h.benkachoud/symfony-rest-api-without-fosrestbundle-using-jwt-authentication-part-2-be394d0924dd
```
1st Step:
Create a user and grant access to the database

```sql
CREATE USER 'gad_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON gad.* TO 'gad_user'@'localhost';
```

2nd Step:
Import the `gad.sql`.

3rd Step:
Clone the repo in your `htdocs` folder and go to `http://localhost/GenderAndDevelopment`.

# sql-packge

sql-packge is a small php wrapper for mysql databases.

## installation

install once with composer:

```
composer require db/sql-packge
```

then add this to your project:

```php
require __DIR__ . '/vendor/autoload.php';
use Db\SqlPackge\sql;
$db = new sql();
```

## usage

```php
/* connect to database */
$db = new sql('127.0.0.1', 'username', 'password', 'database', 3306);

/* exaples */

/* select */
var_dump( $db->select("users","*")->getAll());
var_dump( $db->select("users","*")->where("id","=","9")->getRow());
var_dump( $db->andWhere("id","LIKE","5")->getRow());
var_dump( $db->orWhere("id","BETWEEN","5")->getRow());
var_dump( $db->WhereNot("id","IN","5")->getRow());
var_dump( $db->notWhere("id","<","5")->getRow());



/* insert/update/delete */
var_dump( $db->insert("users",["name"=>"name","email"=>"email","pass"=>"pass"])->set());
var_dump( $db->delete("users","id","7")->set());
var_dump( $db->deleteTable("users")->set());
var_dump( $db->update("users",["name"=>"name","email"=>"email","pass"=>"pass"] , "id = 15")->set());;







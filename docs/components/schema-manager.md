# Slice/SchemaManager

## 1. Introduction

Using SchemaManager, you can define your database schema in php array and keep them in project files. You can also
prepare migration SQL Queries and apply any changes to your database. 

Slice\SchemaManager uses Doctrine DBAL to generate sql-related stuff and establish an Database connection, so you can
work with many types of SQL servers. 


## 2. Best practices

1. Due of security and performance reasons, it is better to work via CLI-mode.
2. Do not keep field definitions as ints (eg. 16, 32 etc) in your schema file. save then as a bitmasks 
(eg.  ```Table::AUTO_INCREMENT | Table::TYPE_INT | Table::PRIMARY_KEY```). Using the second way, you can prevent 
BC breaks.




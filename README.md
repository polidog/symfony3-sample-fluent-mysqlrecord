fluent-output-mysqlrecord sample
=============

[fluent-output-mysqlrecord](https://github.com/polidog/fluent-plugin-mysqlrecord)を利用したSymfony3のサンプル。

## 使い方


```
$ git clone https://github.com/polidog/symfony3-sample-fluent-mysqlrecord.git
$ cd symfony3-sample-fluent-mysqlrecord
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update
```

fluentdの設定

```
<source>
  type unix
</source>


<match app.**>
  type forest
  subtype mysqlrecord
  <template>
     host 127.0.0.1
     database database_name
     username root
     password root
     table ${tag_parts[1]}
     flush_interval 5s
  </template>
</match>
```

### 実際に実行する


```
$ php bin/console app:article:save hoge fuga
```

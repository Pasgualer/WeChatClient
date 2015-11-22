# WeChat 

微信公众平台第三方平台

## 功能列表

 - 自动回复 文本、图文
 - 数据库端实现更改回复内容

=====
## 使用说明

 - 在weixin.config.php中填写微信公众号APPID, APPSECRET, TOKEN
   在微信公众平台开发者选项中可以查看
```php
<?php
    define('APPID','');
    define('APPSECRET','');
    define('TOKEN','');
?>
```
 - 在util/MySqlutil.php中填写数据库相关信息

```php
    /*替换为你自己的数据库名*/
    const dbname = '';
    /*填入数据库连接信息*/
    const host = '';
    const port = ;
    const username = '';//用户AK
    const password = '';//用户SK
```
 - 数据库表的结构说明
     + wechat_rules(rules_id, Content, isInclude, type, reply_id, tag)
         * wechat_textMsg(text_id, Content)
         * wechat_newsMsg(news_id, articleNum, article_id)
             - wechat_articleMsg(article_id, title, discription, picurl, url)

=======

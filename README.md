## 微信小程序-向往的生活商城

1.引用TP5框架为小程序提供接口完成商城项目

2.yum安装php方式[php7.2](https://www.cnblogs.com/itwlp/p/12004150.html)

3.nginx配置

```
server {
        ssl on;

        listen 443;

        ssl_certificate www.kenrou.cn.pem;
        ssl_certificate_key www.kenrou.cn.key;
        ssl_session_timeout 5m;
        ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE:ECDH:AES:HIGH:!NULL:!aNULL:!MD5:!ADH:!RC4;
        ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
        ssl_prefer_server_ciphers on;

        server_name  www.kenrou.cn;
        set $root /var/www/think/think/public;
	root /var/www/think/think/public;

    	error_log /var/log/nginx/think.error.log;
    	access_log /var/log/nginx/think.access.log;

    	#此配置用于静态文件配置
    	#location /static {
   	 #   	try_files $uri $uri/ =404;
    	#}

    location / {
        #开启目录浏览功能
        #autoindex on;
        #关闭详细文件大小统计，让文件大小显示MB，GB单位，默认为b
        #autoindex_exact_size on;
        #开启以服务器本地时区显示文件修改日期
        #autoindex_localtime on;
        if ( !-e $request_filename) {
            rewrite ^/(.*)$ /index.php/$1 last;
            break;
        }
    }

    #配置PHP的pathinfo
    location ~ .+\.php($|/) {
        fastcgi_pass 127.0.0.1:9001;
        fastcgi_index index.php;
        fastcgi_split_path_info ^((?U).+.php)(/?.+)$;
	fastcgi_param HTTPS on;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
        fastcgi_param SCRIPT_FILENAME $root$fastcgi_script_name;
        include fastcgi_params;
    }


    location ~ .*\.(jpg|jpeg|gif|png|ico|swf)$  {
        expires 3y;
        gzip off;
    }
}
```

4.数据库备份文件[数据库](http://blog.kenrou.cn/%E5%B0%8F%E7%A8%8B%E5%BA%8F%E5%90%91%E5%BE%80%E7%9A%84%E7%94%9F%E6%B4%BB%E6%95%B0%E6%8D%AE%E5%BA%93.sql)


![](https://img3.doubanio.com/view/photo/l/public/p2656466940.jpg)

![](https://img9.doubanio.com/view/photo/l/public/p2656466945.jpg)

![](https://img1.doubanio.com/view/photo/l/public/p2656466948.jpg)

![](https://img2.doubanio.com/view/photo/l/public/p2656466951.jpg)

<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'), //只允许自己ip访问这个gii(代码生成工具)
        ),
        //引入我们创建的后台模块houtai
        'houtai',
    ),
    // application components
    'components' => array(
        'request' => array(
//            'enableCsrfValidation' => true, //如果防止post跨站攻击  
//            'enableCookieValidation' => true, //防止Cookie攻击  
        ),
        'user' => array(
            'class' => 'WebUser', //这个WebUser是继承CwebUser，稍后给出它的代码  
            'stateKeyPrefix' => 'member', //这个是设置前台session的前缀  
            'allowAutoLogin' => true, //这里设置允许cookie保存登录信息，一边下次自动登录  
        ),
        'admin' => array(
            'class' => 'AdminWebUser', //后台登录类实例  
            'stateKeyPrefix' => 'admin', //后台session前缀 
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(//访问形式�.html
                '' => array('index/show'),
                '<id:\d+>' => array('friend/return'),
            // '<name:\w+>' =>array('friend/return'),
            // '<controller:\*>/<id:\d+>'=>'<controller>/view',
            // '<id:\d+>/<name:[a-z]+>' => 'friend/reg', // goods/20====>goods/detail&id=20&name=xzj
            ),
        ),
        //配置缓存组件
        'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),
        'db' => array(
            'class' => 'application.extensions.DbConnectionMan', //扩展路径
            'connectionString' => 'mysql:host=localhost;dbname=dama',	//  莎莎源码提醒您此处sasa 为数据库名字
            'emulatePrepare' => true,
            'tablePrefix' => 'xm_',
            'username' => 'root',		//  莎莎源码提醒您此处 root 为数据库用户名
            'password' => 'root',	//  莎莎源码提醒您此处 123456 为数据库密码
            'charset' => 'utf8',
            'slaves' => array(
                array('connectionString' => 'mysql:host=localhost;dbname=dama',	//  莎莎源码提醒您此处 sasa 为数据库密码
                    'emulatePrepare' => true,
                    'tablePrefix' => 'xm_',
                    'username' => 'root',
                    'password' => 'root',
                    'charset' => 'utf8'),
            ),
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    'params' => array(
        'adminEmail' => 'webmaster@example.com',
    ),
);

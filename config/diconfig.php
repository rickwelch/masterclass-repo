<?php
/**
 * Created by PhpStorm.
 * User: welch
 * Date: 2/10/15
 * Time: 8:16 PM
 */

$di = new Aura\Di\Container(new Aura\Di\Factory());

$db = $config['database'];
$dsn = 'mysql:host='.$db['host'].';dbname='.$db['name'];

$di->params['PDO'] = [
  'dsn' => $dsn,
  'username' => $db['user'],
  'passwd' => $db['pass'],
];

$di->params['Masterclass\Model\Comment'] = [
  'pdo' => $di->lazyNew('PDO'),
];

$di->params['Masterclass\Model\Story'] = [
  'pdo' => $di->lazyNew('PDO'),
];

$di->params['Masterclass\FrontController\MasterController'] = [
  'container' => $di,
  'config' => $config,
];

$di->params['Masterclass\Model\Comment'] = [
  'commentModel' => $di->lazyNew('Masterclass\Model\Comment'),
];

$di->params['Masterclass\Model\Story'] = [
  'storyModel' => $di->lazyNew('Masterclass\Model\Story'),
  'commentModel' => $di->lazyNew('Masterclass\Model\Comment'),
];

$di->params['Masterclass\Model\Index'] = [
  'storyModel' => $di->lazyNew('Masterclass\Model\Story'),
];
/*
$di->params['Masterclass\Model\User'] = [
  'config' => $config,
];
*/
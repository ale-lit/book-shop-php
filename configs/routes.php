<?php

  $routes = array(
    'AuthorsController' => array(
      'authors' => 'index',
      'author/add' => 'add',
      'author/edit/([0-9]+)' => 'edit/$1',
      'author/delete/([0-9]+)' => 'delete/$1'
    ),
    'GenresController' => array(
      'genres' => 'index'
    ),
    'GendersController' => array(
      'genders' => 'index'
    ),
    'UsersController' => array(
      'reg' => 'reg',
      'auth' => 'auth',
      'logout' => 'logout'
    )
  );
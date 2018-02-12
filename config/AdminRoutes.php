<?php

return [

'daschboard' => [
    'path' => '/admin/',
    'method' => 'GET',
    'action' => 'DaschboardController',
    'params' => []
  ],

'search_user' => [
    'path' => '/admin/searchUser/',
    'method' => 'POST',
    'action' => 'SearchUserController',
    'params' => []
  ],

  'change_admin' => [
    'path' => '/admin/changeToAdmin/',
    'method' => 'GET',
    'action' => 'UpdateUserController',
    'params' => []
  ],

   'change_user' => [
    'path' => '/admin/changeToUser/',
    'method' => 'GET',
    'action' => 'UpdateUserController',
    'params' => []
  ],

  'delete_user' => [
    'path' => '/admin/deleteUser/',
    'method' => 'GET',
    'action' => 'DeleteUserController',
    'params' => []
  ],

  'ajout_article' => [
    'path' => '/admin/searchUserForm/',
    'method' => 'GET',
    'action' => 'UserFormController',
    'params' => []
  ],

  'articles' => [
    'path' => '/admin/posts/',
    'method' => 'GET',
    'action' => 'ShowPostsController',
    'params' => []
  ],

  'articles_form' => [
    'path' => '/admin/addPostForm/',
    'method' => 'GET',
    'action' => 'AddPostFormController',
    'params' => []
  ],

  'articles_add' => [
    'path' => '/admin/addPost/',
    'method' => 'POST',
    'action' => 'AddedPostController',
    'params' => []
  ],

   'articles_updated' => [
    'path' => '/admin/updatedPost/:id',
    'method' => 'POST',
    'action' => 'UpdatedPostController',
    'params' => [':id' => '#([0-9]+)$#']
  ],

  'articles_update' => [
    'path' => '/admin/updatePost/:id',
    'method' => 'GET',
    'action' => 'UpdatePostController',
    'params' => [':id' => '#([a-zA-Z-_0-9]+)$#']
  ],

   'articles_deleted' => [
    'path' => '/admin/deletePost/:id',
    'method' => 'GET',
    'action' => 'DeletePostController',
    'params' => [':id' => '#([0-9]+)$#']
  ],

  'pages_articles' => [
    'path' => '/admin/posts/:id',
    'method' => 'GET',
    'action' => 'ShowPostsController',
    'params' => [':id' => '#([0-9]+)$#']
  ],



  'commentaires' => [
    'path' => '/admin/comments/',
    'method' => 'GET',
    'action' => 'AllUnvalidCommentsController',
    'params' => []
  ],

   'commentaires_page' => [
    'path' => '/admin/comments/:id',
    'method' => 'GET',
    'action' => 'AllUnvalidCommentsController',
    'params' => [':id' => '#([0-9]+)$#']
  ],

  'commentaires_published' => [
    'path' => '/admin/comments/published/:id',
    'method' => 'GET',
    'action' => 'PublishedCommentController',
    'params' => [':id' => '#([0-9]+)$#']
  ],

   'commentaires_refused' => [
    'path' => '/admin/comments/refused/:id',
    'method' => 'GET',
    'action' => 'RefusedCommentController',
    'params' => [':id' => '#([0-9]+)$#']
  ],



  'networks' => [
    'path' => '/admin/networks/',
    'method' => 'GET',
    'action' => 'NetworksController',
    'params' => []
  ],

  'networks_add' => [
    'path' => '/admin/addNetwork/',
    'method' => 'GET',
    'action' => 'AddNetworkController',
    'params' => []
  ],

  'networks_added' => [
    'path' => '/admin/addedNetwork/',
    'method' => 'POST',
    'action' => 'AddedNetworkController',
    'params' => []
  ],

  'networks_updated' => [
    'path' => '/admin/updateNetwork/:id',
    'method' => 'POST',
    'action' => 'UpdateNetworkController',
    'params' => [':id' => '#([0-9]+)$#']
  ],

    'networks_deleted' => [
    'path' => '/admin/deleteNetwork/:id',
    'method' => 'POST',
    'action' => 'DeleteNetworkController',
    'params' => [':id' => '#([0-9]+)$#']
  ],

  'cv' => [
    'path' => '/admin/cv/',
    'method' => 'GET',
    'action' => 'AddPostController',
    'params' => []
  ],




];
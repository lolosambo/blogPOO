<?php

return [

 'homepage' => [
    'path' => '/',
    'method' => 'GET',
    'action' => P5\controllers\frontend\PostsPaginationController::class,
    'params' => []  
  ],

  'articles' => [
    'path' => '/articles/:id',
    'method' => 'GET',
    'action' => P5\controllers\frontend\PostsPaginationController::class,
    'params' => [':id' => '#([0-9]+)$#']
  ],

  'article' => [
    'path' => '/article/:id',
    'method' => 'GET',
    'action' => P5\controllers\frontend\OnePostController::class,
    'params' => [':id' => '#([^/]+)$#']
  ],

  'comments' => [
    'path' => '/addComment/:id',
    'method' => 'POST',
    'action' => P5\controllers\frontend\OnePostController::class,
    'params' => [':id' => '#([a-zA-Z-_0-9]+)$#']
  ],

  'inscription' => [
    'path' => '/inscriptionForm/',
    'method' => 'GET',
    'action' => P5\controllers\frontend\PostsPaginationController::class,
    'params' => []
  ],

  'inscriptionStatus' => [
    'path' => '/inscriptionStatus/',
    'method' => 'POST',
    'action' => P5\controllers\frontend\PostsPaginationController::class,
    'params' => []
  ],

  'activation' => [
      'path' => '/activation/:id',
    'method' => 'POST',
    'action' => P5\controllers\frontend\AccountController::class,
    'params' => [':id' => '#([0-9]+)$#']
  ],

  'connectionStatus' => [
    'path' => '/connectionStatus/',
    'method' => 'GET',
    'action' => P5\controllers\frontend\PostsPaginationController::class,
    'params' => []
  ],

    'forgotPasswordForm' => [
        'path' => '/forgotPasswordForm/',
        'method' => 'GET',
        'action' => P5\controllers\frontend\PostsPaginationController::class,
        'params' => []
    ],

    'passwordReinitializeForm' => [
        'path' => '/passwordReinitializeForm/:id',
        'method' => 'GET',
        'action' => P5\controllers\frontend\PostsPaginationController::class,
        'params' => [':id' => '#([0-9]+)$#']
    ],

    'passwordReinitialize' => [
        'path' => '/passwordReinitialize/:id',
        'method' => 'POST',
        'action' => P5\controllers\frontend\PostsPaginationController::class,
        'params' => [':id' => '#([a-zA-Z-_0-9]+)$#']
    ],

    'changePassword' => [
        'path' => '/changePassword/',
        'method' => 'POST',
        'action' => P5\controllers\frontend\PostsPaginationController::class,
        'params' => []
    ],

    'ReinitializationError' => [
        'path' => '/reinitializationError/',
        'method' => 'GET',
        'action' => P5\controllers\frontend\PostsPaginationController::class,
        'params' => []
    ],

  'logout' => [
    'path' => '/logout/',
    'method' => 'GET',
    'action' => P5\controllers\frontend\PostsPaginationController::class,
    'params' => []
  ],

'contact' => [
    'path' => '/contact/',
    'method' => 'POST',
    'action' => P5\controllers\frontend\ContactController::class,
    'params' => []
  ],

'presentation' => [
    'path' => '/presentation/',
    'method' => 'POST',
    'action' => P5\controllers\frontend\PresentationController::class,
    'params' => []
  ],

  'cv' => [
    'path' => '/cv/',
    'method' => 'POST',
    'action' => P5\controllers\frontend\CvController::class,
    'params' => []
  ],


  'daschboard' => [
    'path' => '/admin/',
    'method' => 'GET',
    'action' => P5\controllers\backend\DaschboardController::class,
    'params' => []
  ],

'search_user' => [
    'path' => '/admin/searchUser/',
    'method' => 'POST',
    'action' => P5\controllers\backend\SearchUserController::class,
    'params' => []
  ],

  'change_admin' => [
    'path' => '/admin/changeToAdmin/',
    'method' => 'GET',
    'action' => P5\controllers\backend\UpdateUserController::class,
    'params' => []
  ],

   'change_user' => [
    'path' => '/admin/changeToUser/',
    'method' => 'GET',
    'action' => P5\controllers\backend\UpdateUserController::class,
    'params' => []
  ],

  'delete_user' => [
    'path' => '/admin/deleteUser/',
    'method' => 'GET',
    'action' => P5\controllers\backend\DeleteUserController::class,
    'params' => []
  ],

  'ajout_article' => [
    'path' => '/admin/searchUserForm/',
    'method' => 'GET',
    'action' => P5\controllers\backend\UserFormController::class,
    'params' => []
  ],

  'articles_admin' => [
    'path' => '/admin/posts/',
    'method' => 'GET',
    'action' => P5\controllers\backend\ShowPostsController::class,
    'params' => []
  ],

  'articles_form' => [
    'path' => '/admin/addPostForm/',
    'method' => 'GET',
    'action' => P5\controllers\backend\AddPostFormController::class,
    'params' => []
  ],

  'articles_add' => [
    'path' => '/admin/addPost/',
    'method' => 'POST',
    'action' => P5\controllers\backend\AddedPostController::class,
    'params' => []
  ],

   'articles_updated' => [
    'path' => '/admin/updatedPost/:id',
    'method' => 'POST',
    'action' => P5\controllers\backend\UpdatedPostController::class,
    'params' => [':id' => '#([0-9]+)$#']
  ],

  'articles_update' => [
    'path' => '/admin/updatePost/:id',
    'method' => 'GET',
    'action' => P5\controllers\backend\UpdatePostController::class,
    'params' => [':id' => '#([a-zA-Z-_0-9]+)$#']
  ],

   'articles_deleted' => [
    'path' => '/admin/deletePost/:id',
    'method' => 'GET',
    'action' => P5\controllers\backend\DeletePostController::class,
    'params' => [':id' => '#([0-9]+)$#']
  ],

  'pages_articles' => [
    'path' => '/admin/posts/:id',
    'method' => 'GET',
    'action' => P5\controllers\backend\ShowPostsController::class,
    'params' => [':id' => '#([0-9]+)$#']
  ],



  'commentaires' => [
    'path' => '/admin/comments/',
    'method' => 'GET',
    'action' => P5\controllers\backend\AllUnvalidCommentsController::class,
    'params' => []
  ],

   'commentaires_page' => [
    'path' => '/admin/comments/:id',
    'method' => 'GET',
    'action' => P5\controllers\backend\AllUnvalidCommentsController::class,
    'params' => [':id' => '#([0-9]+)$#']
  ],

  'commentaires_published' => [
    'path' => '/admin/published/:id',
    'method' => 'GET',
    'action' => P5\controllers\backend\PublishedCommentController::class,
    'params' => [':id' => '#([0-9]+)$#']
  ],

   'commentaires_refused' => [
    'path' => '/admin/refused/:id',
    'method' => 'GET',
    'action' => P5\controllers\backend\RefusedCommentController::class,
    'params' => [':id' => '#([0-9]+)$#']
  ],



  'networks' => [
    'path' => '/admin/networks/',
    'method' => 'GET',
    'action' => P5\controllers\backend\NetworksController::class,
    'params' => []
  ],

  'networks_add' => [
    'path' => '/admin/addNetwork/',
    'method' => 'GET',
    'action' => P5\controllers\backend\AddNetworkController::class,
    'params' => []
  ],

  'networks_added' => [
    'path' => '/admin/addedNetwork/',
    'method' => 'POST',
    'action' => P5\controllers\backend\AddedNetworkController::class,
    'params' => []
  ],

  'networks_updated' => [
    'path' => '/admin/updateNetwork/:id',
    'method' => 'POST',
    'action' => P5\controllers\backend\UpdateNetworkController::class,
    'params' => [':id' => '#([0-9]+)$#']
  ],

    'networks_deleted' => [
    'path' => '/admin/deleteNetwork/:id',
    'method' => 'POST',
    'action' => P5\controllers\backend\DeleteNetworkController::class,
    'params' => [':id' => '#([0-9]+)$#']
  ],

  'cv_admin' => [
    'path' => '/admin/cv/',
    'method' => 'GET',
    'action' => P5\controllers\backend\AddPostController::class,
    'params' => []
  ],

];



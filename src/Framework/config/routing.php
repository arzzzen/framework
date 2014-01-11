<?php
  $this->routes = array(
    array(
      'path'      => '/',
      'controller' => 'Main',
      'action'     => 'index'
      ),
    array(
      'path'      => '/page',
      'controller' => 'Main',
      'action'     => 'page'
      ),
    array(
      'path'      => '/twig',
      'controller' => 'Main',
      'action'     => 'twig'
      )
    );
?>
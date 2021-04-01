<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="alternate" type="application/rss+xml" title="<?= get_bloginfo('name'); ?> Feed" href="<?= esc_url(get_feed_link()); ?>">
    <?php wp_head(); ?>
    <?php get_template_part('templates/analyticstracking'); ?>

    <link rel="shortcut icon" href="<?php bloginfo('template_directory');?>/public/img/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css'>
  </head>

<?php

require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$articleRepository = new ArticleRepository('articles.json');
	$title = $_GET['id'];
	$articleRepository->deleteArticleById($title);
	header('Location: index.php?from=delete_article');
}



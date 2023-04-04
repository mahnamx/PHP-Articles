<?php

require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';
require_once 'helpers/helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$articleRepository = new ArticleRepository('articles.json');
	$title = $_POST['article_title'];
	$url = $_POST['article_url'];
$photourl = !empty($_POST['article_photourl']) ? $_POST['article_photourl'] : 'https://icons-for-free.com/iconfiles/png/512/article+data+document+file+files+newspaper+office+paper-1320185653273206420.png';


	if (!validTitle($title)) {
    header('Location: new_article.php?title_error=Invalid title provided.');
    exit();
} elseif (strlen($title) > 150) {
    header('Location: new_article.php?title_error=Title cannot exceed 150 characters.');
    exit();
}


	if (!validUrl($url)) {
		header('Location: new_article.php?url_error=Invalid URL provided.');
		exit();
	}

  if (!validUrl($photourl)) {
		header('Location: new_article.php?photourl_error=Invalid Photo URL provided.');
		exit();
	}


	$articleRepository->saveArticle(new Article(time(), $title, $url, $photourl));
    header('Location: index.php?from=new_article&saved=true');
}
?>

<!doctype html>
<html lang="en">
   <head>
     <style>
		#mydiv {
		  border: 1px solid #ccc;
		  background-color: #f7f7f7;
		  padding: 20px;
      margin-left:400px;
      margin-right:400px;
      
		}
	</style>
   </head>
<?php require_once 'layout/header.php'?>
<body>
<?php require_once 'layout/navigation.php'?>
<div id="mydiv" class="flex min-h-full items-center justify-center px-4 mt-16 sm:px-6 lg:px-8">
	<div class="w-full max-w-xl space-y-8">
		<div>
			<h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900 text-center">Submit a New Article</h2>
		</div>

		<form class="space-y-6" action="new_article.php" method="POST">
			<div class="rounded-md">
				<div>
					<span class="error text-red-500"><?= isset($_GET['title_error']) ? htmlspecialchars($_GET['title_error']) : '' ?></span>
					<label for="article_title" class="sr-only">Article Title</label>
					<input id="article_title" name="article_title" type="text"
						   class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
						   placeholder="Article Title">
				</div>
				<div class="mt-2">
					<span class="error text-red-500"><?= isset($_GET['url_error']) ? htmlspecialchars($_GET['url_error']) : '' ?></span>
					<label for="article_url" class="sr-only">Article URL</label>
					<input id="article_url" name="article_url" type="text"
						   class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
						   placeholder="Article URL">
          					<span class="error text-red-500"><?= isset($_GET['photourl_error']) ? htmlspecialchars($_GET['photourl_error']) : '' ?></span>
          <label for="article_photourl" class="sr-only">Article Photo URL</label>
<input id="article_photourl" name="article_photourl" type="text"
   class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
   placeholder="Article Photo URL (optional)">

				</div>
        
			</div>

			<div>
				<div class="flex justify-between">
    <button type="submit"
            class="group relative flex justify-center w-1/2 rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Add Article
    </button>
    <a href="index.php" class="group relative flex justify-center w-1/2 rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
        Cancel
    </a>
</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>

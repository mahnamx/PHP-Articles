<?php

require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';
require_once 'helpers/helpers.php';

$articleRepository = new ArticleRepository('articles.json');
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
	$articleId = $_GET['id'];
	$article = $articleRepository->getArticleById($articleId);
}
else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = $_POST['article_title'];
	$url = $_POST['article_url'];
    $id = $_POST['article_id'];
  $photourl = !empty($_POST['article_photourl']) ? $_POST['article_photourl'] : 'https://icons-for-free.com/iconfiles/png/512/article+data+document+file+files+newspaper+office+paper-1320185653273206420.png';


	if (!validTitle($title)) {
		header("Location: update_article.php?id=$id&title_error=Invalid title provided.");
		exit();
	}

	if (!validUrl($url)) {
		header("Location: update_article.php?id=$id&url_error=Invalid URL provided.");
		exit();
	}

	if (empty($id)) {
		header('Location: update_article.php?error=Invalid request.');
		exit();
	}

if (isset($_POST['photo_url'])) {
    $photoUrl = $_POST['photo_url'];

    if (!validPhotoUrl($photoUrl)) {
        header('Location: update_article.php?photo_error=Invalid photo URL provided.');
        exit();
    }
} else {
}


	$articleRepository->updateArticle($id, new Article($id, $title, $url, $photourl));
	header('Location: index.php?from=update_article&saved=true');
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head><style>
		#mydiv {
		  border: 1px solid #ccc;
		  background-color: #f7f7f7;
		  padding: 20px;
      margin-left:400px;
      margin-right:400px;
      
		}
	</style></head>
<?php require_once 'layout/header.php'?>
<body>
<?php require_once 'layout/navigation.php'?>
<div id="mydiv" class="flex min-h-full items-center justify-center px-4 mt-16 sm:px-6 lg:px-8">
	<div class="w-full max-w-xl space-y-8">
		<div>
			<h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900 text-center">Update Article</h2>
		</div>

		<form class="space-y-6" action="update_article.php" method="POST">

            <input type="hidden" name="article_id" value="<?= $article->getId() ?>">

			<div class="rounded-md">
				<div>
					<span class="error text-red-500"><?= isset($_GET['title_error']) ? htmlspecialchars($_GET['title_error']) : '' ?></span>
					<label for="article_title" class="sr-only">Article Title</label>
					<input id="article_title" name="article_title" type="text"
						   class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
						   placeholder="Article Title"
						   value="<?php echo !isset($_GET['title_error']) ? $article->getTitle() : ''; ?>">
				</div>
				<div class="mt-2">
					<span class="error text-red-500"><?= isset($_GET['url_error']) ? htmlspecialchars($_GET['url_error']) : '' ?></span>
					<label for="article_url" class="sr-only">Article URL</label>
					<input id="article_url" name="article_url" type="text"
						   class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
						   placeholder="Article URL"
						   value="<?php echo !isset($_GET['url_error']) ? $article->getUrl() : ''; ?>">
                <label for="article_photo" class="sr-only">Article Photo URL</label>
<input id="article_photourl" name="article_photourl" type="text"
   class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
   placeholder="Article Photo URL (optional)"
          						   value="<?php echo !isset($_GET['photo_error']) ? $article->getPhotoUrl() : ''; ?>">
				</div>
			</div>

			<div class="flex justify-between">
    <button type="submit"
            class="group relative flex justify-center w-1/2 rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Update Article
    </button>
    <a href="index.php" class="group relative flex justify-center w-1/2 rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
        Cancel
    </a>
</div>

		</form>
	</div>
</div>
</body>
</html>

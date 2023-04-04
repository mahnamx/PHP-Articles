<?php
require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';
$articleRepository = new ArticleRepository('articles.json');
$articles = $articleRepository->getAllArticles();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.17/tailwind.min.css">
    <link rel="stylesheet" href="layout/styles.css">
    <script src="https://kit.fontawesome.com/a43caa5ef6.js" crossorigin="anonymous"></script>
    
  </head>
  <body>

    <?php require_once 'layout/navigation.php'?>

    <div class="mx-auto max-w-6xl  sm:px-6 lg:px-8">


<p class="text"><i class="fa-brands fa-php"> Articles</i></p>
      <?php echo count($articles) === 0 ? "<p class='text-center'>No posts yet.</p>" : ""; ?>

      <div class="overflow-hidden bg-white shadow sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200">

          <?php foreach ($articles as $article): ?>
            <li>
              <div class="inline-block">
                <a href="<?= $article->getUrl(); ?>" target="_blank" class="block  inline-block">
                  <div class="flex items-center px-4 py-4 sm:px-6">
                    <div class="flex-shrink-0">
            <img class="h-20 w-20 rounded article-photo" src="<?= $article->getPhotoUrl() ?>" alt="Article photo">
          </div>
                    <div class="flex-1 sm:flex sm:items-center sm:justify-between">
                      <div class="truncate">
                        <div class="flex text-sm">
                          <p class="truncate font-medium text-indigo-900"><?= $article->getTitle(); ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="inline-block float-right mt-4 mr-4">
                <a href="update_article.php?id=<?= $article->getId(); ?>" class="inline-block px-2 py-1 bg-green-500 hover:bg-green-600 text-white rounded">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="black" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                            </svg>
</a>

                <a href="delete_article.php?id=<?= $article->getId(); ?>" class="inline-block px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded" onclick="return confirm('Are you sure you want to delete this article?')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="black" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                            </svg></a>
              </div>
            </li>
          <?php endforeach; ?>

        </ul>
      </div>

    </div>

  </body>
</html>

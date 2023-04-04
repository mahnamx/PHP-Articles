<?php
class ArticleRepository {

	private string $filename;

	public function __construct(string $theFilename) {
		$this->filename = $theFilename;
	}

	/**
	 * @return Article[]
	 */
	public function getAllArticles(): array {
		if (!file_exists($this->filename)) {
			return [];
		}
		$fileContents = file_get_contents($this->filename);
		if (!$fileContents) {
			return [];
		}
		$decodedArticles = json_decode($fileContents, true);
		if (json_last_error() !== JSON_ERROR_NONE) {
			return [];
		}
		$articles = [];
		foreach ($decodedArticles as $decodedArticle) {
			$articleId = time();
			$articles[] = (new Article($articleId))->fill($decodedArticle);
		}
		return $articles;
	}

	/**
	 *
	 */
	public function getArticleById(int $id): Article|null {
		$articles = $this->getAllArticles();
		foreach ($articles as $article) {
			if ($article->getId() === $id) {
				return $article;
			}
		}
		return null;
	}

	/**
	 * @param int $id
	 */
	public function deleteArticleById(int $id): void {
		$articles = $this->getAllArticles();
		foreach ($articles as $key => $book) {
			if ($book->getId() === $id) {
				unset($articles[$key]);
			}
		}
		file_put_contents($this->filename, json_encode(array_values($articles), JSON_PRETTY_PRINT));
	}

	/**
	 * @param Article $article
	 */
	public function saveArticle(Article $article): void {
		$articles = $this->getAllArticles();
		$articles[] = $article;
		file_put_contents($this->filename, json_encode($articles, JSON_PRETTY_PRINT));
	}

	/**
	 * @param int $id
	 * @param Article $updatedArticle
	 */
	public function updateArticle(int $id, Article $updatedArticle): void {
		$articles = $this->getAllArticles();
		foreach ($articles as $key => $article) {
			if ($article->getId() === $id) {
				$articles[$key] = $updatedArticle;
			}
		}
		file_put_contents($this->filename, json_encode($articles, JSON_PRETTY_PRINT));
	}

}

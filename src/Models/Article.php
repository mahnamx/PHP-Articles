<?php
class Article implements JsonSerializable {

	private string $title;
	private string $url;
	private string $photoUrl; // new property
	private int $id;

	/**
	 * @param int $id
	 * @param string $title
	 * @param string $url
	 * @param string $photoUrl
	 */
	public function __construct(int $id, string $title = '', string $url = '', string $photoUrl = '') {
		$this->id = time();
		$this->title = $title;
		$this->url = $url;
		$this->photoUrl = $photoUrl;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle(string $title): void {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getUrl(): string {
		return $this->url;
	}

	/**
	 * @param string $url
	 */
	public function setUrl(string $url): void {
		$this->url = $url;
	}

	/**
	 * @return string
	 */
	public function getPhotoUrl(): string {
		return $this->photoUrl;
	}

	/**
	 * @param string $photoUrl
	 */
	public function setPhotoUrl(string $photoUrl): void {
		$this->photoUrl = $photoUrl;
	}

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id): void {
		$this->id = $id;
	}

	/**
	 * @param $articleData
	 *  an associative array of book data e.g.
	 *      [
	 *          'title' => 'Slow decline in COVID-19 hospitalizations in B.C. continues',
	 *          'url' => 'https://www.cbc.ca/news/canada/british-columbia/british-columbia-covid-19-update-1.6592422',
	 *          'photoUrl' => 'https://example.com/image.jpg', // new property
	 *      ]
	 * and we get an Article object returned
	 */
	public function fill(array $articleData): Article {
		foreach ($articleData as $key => $value) {
			$this->{$key} = $value; // dynamically add properties to the Book object
		}
		return $this;
	}

	public function jsonSerialize(): array {
		return [
			'id' => $this->getId(),
			'title' => $this->getTitle(),
			'url' => $this->getUrl(),
			'photoUrl' => $this->getPhotoUrl(), // new property
		];
	}

}

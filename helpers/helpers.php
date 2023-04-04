<?php

function validUrl(string $url): bool {
	return filter_var($url, FILTER_VALIDATE_URL);
}

function validTitle(string $title): bool {
	return !empty($title);
}function getPhotoUrl(string $photoUrl): string {
    $imageFormats = array('jpg', 'jpeg', 'png', 'gif');
    $fileExtension = strtolower(pathinfo($photoUrl, PATHINFO_EXTENSION));
    if (in_array($fileExtension, $imageFormats)) {
        $headers = get_headers($photoUrl);
        if (preg_match('/^HTTP\/\d+\.\d+\s+2\d\d\s+.*$/i', $headers[0])) {
            return $photoUrl;
        }
    }
    return 'https://icons-for-free.com/iconfiles/png/512/article+data+document+file+files+newspaper+office+paper-1320185653273206420.png';
}

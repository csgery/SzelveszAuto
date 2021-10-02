<?php
function validateFileUpload(string $tmpPath, string $targetPath, string $fileType): array {
    $uploadErrors = [];


    if(empty($tmpPath)){
        $uploadErrors['image'][] = 'Autó képe nem lehet üres!';
    }

    elseif (isset($_FILES['image'])
        || !file_exists($tmpPath)
        || $_FILES['image']['size'] !== filesize($tmpPath)
    ) {
        $uploadErrors['_'][] = 'Hiba történt a kép feltöltése során. Kérem próbálja meg újra.';
    }



    elseif(!in_array(needle:  $fileType, haystack:  array("jpg",'jpeg', 'bmp', 'png'))){
        $uploadErrors['image'][] = 'Nem támogatott a kép formátuma (Támogatott: jpg/jpeg/bmp/png).';
    }

    elseif ($_FILES['image']['size'] < 9_000_000) {
        $uploadErrors['image'][] = 'A kép nagyobb, mint 9MB.';
    }

    elseif (file_exists($targetPath)) {
        $uploadErrors['image'][] = 'Már található kép ilyen néven.'; 
    }



    return $uploadErrors;
}
<?php
function uploads(string $src): string{
    return "public/img/cars/$src";
}

function getExtension(string $targetPath): string{
    return strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
}
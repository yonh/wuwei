<?php
if (file_exists(__DIR__ . '/index.html')) {
    echo file_get_contents(__DIR__ . '/index.html');
    exit;
}

echo '<meta charset="UTF-8"/>';

$path = dirname(__FILE__) . '';  // 路径

$result = files($path);

$result = array_diff($result, ['/index.phpa']);
echo "<ul>";
foreach ($result as $item) {
    echo "<li><a download='".substr($item,1)."' href='".($item)."'>".$item."</a></li>";
}
echo "</ul>";


function files($path)
{
    $directory = new RecursiveDirectoryIterator($path); //The RecursiveDirectoryIterator provides an interface for iterating recursively over filesystem directories.
    $recursive = new RecursiveIteratorIterator($directory,RecursiveIteratorIterator::SELF_FIRST);

    $start = strlen($path);
    $result = [];
    //各项都包含，例如递归文件夹就会连同子文件夹名称也作为其中项输出，顺序是先父后子
    /** @var SplFileInfo $file */
    foreach($recursive as $file) {
        if ($file->isFile()) {
            $result[] = substr($file->getPath(), $start) . "/" . $file->getFilename();
            $file->getFilename();
        }
    }

    return $result;
}

<?php
// List files older than a year, which might get a little old, or unused, or obsolete.


//git log -1 --pretty="format:%ct" /path/to/repo/anyfile.any)

 //git ls-files --full-name


exec('git ls-files --full-name', $filesInTree);


$twoYearsAgoObject = new DateTime('-2 year');
$yearAgoObject = new DateTime('-1 year');

$filesNotModifiedInLastTwoYears = [];
$filesNotModifiedInLastYear = [];


foreach ($filesInTree as $file) {
    $lastRevisionDate = [];
    exec(
        sprintf('git log -1 --pretty="format:%%ci" %s', $file),
        $lastRevisionDate
    );

    // skip untracked
    if(isset($lastRevisionDate[0]) === false) {
        continue;
    }

    $lastRevisionDateObject = new DateTime($lastRevisionDate[0]);
    if($lastRevisionDateObject < $twoYearsAgoObject) {
        $filesNotModifiedInLastTwoYears[] = [$file, $lastRevisionDate[0]];
        continue;
    }
    if($lastRevisionDateObject < $yearAgoObject) {
        $filesNotModifiedInLastYear[] = [$file, $lastRevisionDate[0]];

    }
}


echo str_repeat('-', 160).PHP_EOL;
echo '| Files not modified in last 2 years:'.PHP_EOL;
echo str_repeat('-', 160).PHP_EOL;
foreach ($filesNotModifiedInLastTwoYears as $data) {
    echo sprintf('| %25s | %-125s |'.PHP_EOL, $data[1], $data[0]);
}

echo str_repeat('-', 160).PHP_EOL;
echo '| Files not modified in last year:'.PHP_EOL;
echo str_repeat('-', 160).PHP_EOL;
foreach ($filesNotModifiedInLastYear as $data) {
    echo sprintf('| %25s | %-125s |'.PHP_EOL, $data[1], $data[0]);
}

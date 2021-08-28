<?php
/**
 * rdepcheck.php
 */


function println(string $line): void {
    echo $line.PHP_EOL;
}


println('Im going to check your composer.json files!');


$cwd = getcwd();


println('Scanning src dir...');
$dirIterator = new RecursiveDirectoryIterator(sprintf('%s/src', $cwd));
$iterator = new RecursiveIteratorIterator($dirIterator);

$packagesFound = [];
$errors = [];

foreach ($iterator as $file) {
    /** @var SplFileInfo $file */
    if($file->getFilename() === 'composer.json') {
        $packagesFound[] = $file->getPathname();
    }
}

if(count($packagesFound) === 0) {
    println('Found nothing.');
    die(0);
}


$requiredKey = ['name', 'license', 'description', 'autoload'];

println('Processing files...');
foreach ($packagesFound as $package) {
    try {
        $composerFile = json_decode(file_get_contents($package), true, 512,  JSON_THROW_ON_ERROR);

        foreach ($requiredKey  as $key) {
            if(!isset($composerFile[$key])) {
                $errors[] = sprintf('%s: missing "%s" key', $package, $key);
                continue 2;
            }
        }

        if($composerFile['license'] !== 'MIT') {
            $errors[] = sprintf('%s: invalid license (should be MIT, uppercased)', $package, $key);
        }



    } catch (JsonException $exception) {
        $errors[] = sprintf('Unable to parse %s: %s', $package, $exception->getMessage());
    }
}



if(count($errors) > 0) {
    println('Got Errors:');

    foreach ($errors as $error) {
        println($error);
    }

    die(1);
}

println('Done');
die(0);


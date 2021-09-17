<?php
/**
 * Performs a deep dive in your project and checks if your nested composer.json files are valid.
 * @license MIT
 */


function println(string $line): void
{
    echo $line . PHP_EOL;
}

function getJsonContents(string $file): array
{
    return json_decode(file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);
}

function getNestedJsonPackages(string $path): array
{
    $packagesFound = [];
    $dirIterator = new RecursiveDirectoryIterator($path);
    $iterator = new RecursiveIteratorIterator($dirIterator);
    foreach ($iterator as $file) {
        /** @var SplFileInfo $file */
        if ($file->getFilename() === 'composer.json') {
            $packagesFound[] = $file->getPathname();
        }
    }

    return $packagesFound;
}

println('Im going to check your composer.json files!');


$cwd = getcwd();


println('Scanning src dir.');

$nestedPackages = [];

$coreComposerFile = sprintf('%s/composer.json', $cwd);
$packagesFound = getNestedJsonPackages(sprintf('%s/src', $cwd));

$errors = [];


if (count($packagesFound) === 0) {
    println('Found nothing.');
    die(0);
}


$requiredKey = ['name', 'license', 'description', 'autoload'];

println('Checking for basic composer.json issues.');
foreach ($packagesFound as $package) {
    try {
        $composerFile = getJsonContents($package);

        foreach ($requiredKey as $key) {
            if (!isset($composerFile[$key])) {
                $errors[] = sprintf('%s: missing "%s" key', $package, $key);
                continue 2;
            }
        }

        /**
         * jadob/jadob is MIT licensed so each subcomponents must be MIT licensed too.
         */
        if ($composerFile['license'] !== 'MIT') {
            $errors[] = sprintf('%s: invalid license (should be MIT, uppercased)', $package);
        }


        $nestedPackages[$coreComposerFile][] = $package;
        $nestedPackagesForPackage = getNestedJsonPackages(dirname($package));
        foreach ($nestedPackagesForPackage as $key => $value) {
            if($value === $package) {
                unset($nestedPackagesForPackage[$key]);
            }
        }
        if(count($nestedPackagesForPackage) > 0) {
            $nestedPackages[$package] = $nestedPackagesForPackage;
        }
    } catch (JsonException $exception) {
        $errors[] = sprintf('Unable to parse %s: %s', $package, $exception->getMessage());
    }
}

println('Checking for nesting replaces.');


foreach ($nestedPackages as $packagePath => $nestedPackagePaths) {
    $corePackage = getJsonContents($packagePath);
    foreach ($nestedPackagePaths as $nestedPackagePath) {
        $nestedPackage = getJsonContents($nestedPackagePath);
        $nestedPackageName = $nestedPackage['name'];

        /**
         * There must be an "replace" entry on each composer.json in parent directory.
         * Example:
         * /composer.json - replaces X, Y and Z
         * /X/composer.json - replaces Y and Z
         * /X/Y/composer.json - replaces Z
         * /X/Y/Z/composer.json - no nested projects, provides no replaces
         */
        if(!isset($corePackage['replace'][$nestedPackageName])) {
            $errors[] = sprintf('%s: missing replace.%s ', $packagePath, $nestedPackageName);
        }
    }

}

if (count($errors) > 0) {
    println('Got Errors:');

    foreach ($errors as $error) {
        println($error);
    }

    die(1);
}

println('Nice, no errors found!');
die(0);


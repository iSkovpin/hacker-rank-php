<?php

if ($argc < 2) {
    echo 'Send the filename as a first argument' . "\n";
    exit(1);
}

$fileName = __DIR__ . '/' . $argv[1];
$filePath = realpath($fileName);
$testsDir = dirname($filePath) . '/tests/' . basename($filePath, ".php");
$testsDirs = [
    'root'     => $testsDir,
    'input'    => $testsDir . '/input',
    'e_output' => $testsDir . '/expected_output',
    'r_output' => $testsDir . '/real_output',
];
$testNames = [];
$testFileNames = [];

$getTestFiles = function ($name) use ($testsDirs) {
    $fileName = $name . '.txt';
    return [
        $testsDirs['input'] . '/' . $fileName,
        $testsDirs['e_output'] . '/' . $fileName,
        $testsDirs['r_output'] . '/' . $fileName,
    ];
};

$checkTestFiles = function ($testFiles) {
    foreach ([$testFiles[0], $testFiles[1]] as $fileName) {
        if (!is_file($fileName)) {
            echo "Test file '$fileName' doesn't exist";
            exit(1);
        }
    }
};

if (count($argv) > 2) {
    for ($i = 2; $i < count($argv); $i++) {
        $testNames[] = $argv[$i];
    }
}

if (empty($filePath)) {
    echo "File '$fileName' not found\n";
    exit(1);
}

if (isset($testNames[0]) && $testNames[0] === 'init') {
    foreach ($testsDirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755);
        }
    }

    for ($i = 1; $i < count($testNames); $i++) {
        $testFiles = $getTestFiles($testNames[$i]);
        foreach ($testFiles as $file) {
            if (!is_file($file)) {
                touch($file);
            }
        }
    }

    $gitKeep = $testsDirs['r_output'] . '/.gitkeep';
    if (!is_file($gitKeep)) {
        touch($gitKeep);
    }

    echo "Tests dir structure for a file '$fileName' successfully created\n";
    exit(0);
}

foreach ($testsDirs as $dir) {
    if (!is_dir($dir)) {
        echo "Initialize tests dir structure first, like\n";
        echo "php test.php $argv[1] init\n";
        exit(1);
    }
}

if (empty($testNames)) {
    foreach (scandir($testsDirs['input']) as $file) {
        if (in_array($file, ['.', '..'])) {
            continue;
        }
        $testNames[] = basename($file, '.txt');
    }
}

foreach ($testNames as $name) {
    $testFileNames[$name] = $getTestFiles($name);
    $checkTestFiles($testFileNames[$name]);
}

printf("%s tests are running\n", count($testNames));

$successCount = 0;
foreach ($testFileNames as $testName => $fileNames) {
    echo "Test $testName ...";
    $output = shell_exec("export OUTPUT_PATH=\"$fileNames[2]\" && php $fileName < $fileNames[0]");

    if (!is_file($fileNames[2])) {
        file_put_contents($fileNames[2], $output);
    }

    if (trim(file_get_contents($fileNames[1])) === trim(file_get_contents($fileNames[2]))) {
        $successCount++;
        echo " OK\n";
    } else {
        echo " Failed\n";
    }
}

printf("%d of %d tests passed successfully\n", $successCount, count($testNames));

<?php

declare(strict_types=1);

namespace Codewithkyrian\TransformersLibrariesDownloader;

use RuntimeException;

enum Library
{
    case OnnxRuntime;
    case OpenBlas;
    case RindowMatlib;
    case Sndfile;
    case Samplerate;
    case FastTransformersUtils;


    public function header(string $includeDir, bool $fatal = true): ?string
    {
        $filename = match ($this) {
            self::OnnxRuntime => 'onnxruntime.h',
            self::OpenBlas => 'openblas.h',
            self::RindowMatlib => 'matlib.h',
            self::Sndfile => 'sndfile.h',
            self::Samplerate => 'samplerate.h',
            self::FastTransformersUtils => 'fast_transformers_utils.h',
        };

        $headerFile = $this->joinPaths($includeDir, $filename);

        if (!file_exists($headerFile)) {
            if ($fatal) {
                throw new RuntimeException('Header file not found: '.$filename);
            }
            return null;
        }

        return $headerFile;
    }

    public function library(string $libDir, bool $fatal = true): ?string
    {
        $libraryName = match ($this) {
            self::OnnxRuntime => 'libonnxruntime',
            self::OpenBlas => 'libopenblas',
            self::RindowMatlib => 'librindowmatlib',
            self::Sndfile => 'libsndfile',
            self::Samplerate => 'libsamplerate',
            self::FastTransformersUtils => 'libfast_transformers_utils',
        };

        $extension = match (PHP_OS_FAMILY) {
            'Windows' => '.dll',
            'Darwin' => '.dylib',
            default => '.so',
        };

        $libraryFile = $this->joinPaths($libDir, $libraryName.$extension);

        if (!file_exists($libraryFile)) {
            if ($fatal) {
                throw new RuntimeException('Library file not found: '.$libraryFile);
            }
            return null;
        }

        return $libraryFile;
    }

    public function exists(string $libDir): bool
    {
        return $this->library($libDir, false) !== null;
    }

    public static function joinPaths(string ...$args): string
    {
        $paths = [];

        foreach ($args as $key => $path) {
            if ($path === '') {
                continue;
            } elseif ($key === 0) {
                $paths[$key] = rtrim($path, '/');
            } elseif ($key === count($paths) - 1) {
                $paths[$key] = ltrim($path, '/');
            } else {
                $paths[$key] = trim($path, '/');
            }
        }

        return preg_replace('#(?<!:)//+#', '/', implode(DIRECTORY_SEPARATOR, $paths));
    }
}

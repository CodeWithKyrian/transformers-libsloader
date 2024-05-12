<?php

declare(strict_types=1);


namespace Codewithkyrian\TransformersLibrariesDownloader;

enum Libraries
{
    case OpenBlas_Serial;
    case OpenBlas_OpenMP;
    case RindowMatlib_Serial;
    case RindowMatlib_OpenMP;
    case Lapacke_Serial;
    case Lapacke_OpenMP;
    case OnnxRuntime;

    private const BASE_URL = 'https://github.com/codewithkyrian/transformers-libraries-downloader/releases/download/{{version}}/';
    protected const LIBRARIES = [
        'x86_64-darwin' => [
            'archive_format' => 'tar.gz',
            'rindowmatlib.serial' => [
                'folder' => 'rindow-matlib-darwin-x86_64-{{version}}',
                'lib' => 'librindowmatlib_serial.dylib',
                'header' => 'matlib.h'
            ],
            'rindowmatlib.openmp' => [
                'folder' => 'rindow-matlib-darwin-x86_64-{{version}}',
                'lib' => 'librindowmatlib_openmp.dylib',
                'header' => 'matlib.h'
            ],
            'openblas.serial' => [
                'folder' => 'openblas-osx-x86_64-{{version}}',
                'lib' => 'libopenblas_serial.dylib',
                'header' => 'openblas.h'
            ],
            'openblas.openmp' => [
                'folder' => 'openblas-osx-x86_64-{{version}}',
                'lib' => 'libopenblas_openmp.dylib',
                'header' => 'openblas.h'
            ],
            'lapacke.serial' => [
                'folder' => 'openblas-osx-x86_64-{{version}}',
                'lib' => 'libopenblas_serial.dylib',
                'header' => 'lapacke.h'
            ],
            'lapacke.openmp' => [
                'folder' => 'openblas-osx-x86_64-{{version}}',
                'lib' => 'libopenblas_openmp.dylib',
                'header' => 'lapacke.h'
            ],
            'onnxruntime' => [
                'folder' => 'onnxruntime-osx-x86_64-{{version}}',
                'lib' => 'libonnxruntime.dylib',
                'header' => 'onnxruntime.h'
            ],
        ],

        'arm64-darwin' => [
            'archive_format' => 'tar.gz',
            'rindowmatlib.serial' => [
                'folder' => 'rindow-matlib-darwin-arm64-{{version}}',
                'lib' => 'librindowmatlib_serial.dylib',
                'header' => 'matlib.h'
            ],
            'rindowmatlib.openmp' => [
                'folder' => 'rindow-matlib-darwin-arm64-{{version}}',
                'lib' => 'librindowmatlib_openmp.dylib',
                'header' => 'matlib.h'
            ],
            'openblas.serial' => [
                'folder' => 'openblas-osx-arm64-{{version}}',
                'lib' => 'libopenblas_serial.dylib',
                'header' => 'openblas.h'
            ],
            'openblas.openmp' => [
                'folder' => 'openblas-osx-arm64-{{version}}',
                'lib' => 'libopenblas_openmp.dylib',
                'header' => 'openblas.h'
            ],
            'lapacke.serial' => [
                'folder' => 'openblas-osx-arm64-{{version}}',
                'lib' => 'libopenblas_serial.dylib',
                'header' => 'lapacke.h'
            ],
            'lapacke.openmp' => [
                'folder' => 'openblas-osx-arm64-{{version}}',
                'lib' => 'libopenblas_openmp.dylib',
                'header' => 'lapacke.h'
            ],
            'onnxruntime' => [
                'folder' => 'onnxruntime-osx-arm64-{{version}}',
                'lib' => 'libonnxruntime.dylib',
                'header' => 'onnxruntime.h'
            ],
        ],

        'x86_64-linux' => [
            'archive_format' => 'tar.gz',
            'rindowmatlib.serial' => [
                'folder' => 'rindow-matlib-linux-{{version}}',
                'lib' => 'librindowmatlib_serial.so',
                'header' => 'matlib.h'
            ],
            'rindowmatlib.openmp' => [
                'folder' => 'rindow-matlib-Linux-{{version}}',
                'lib' => 'librindowmatlib_openmp.so',
                'header' => 'matlib.h'
            ],
            'openblas.serial' => [
                'folder' => 'openblas-linux-x86_64-{{version}}',
                'lib' => 'libopenblas_serial.so',
                'header' => 'openblas.h'
            ],
            'openblas.openmp' => [
                'folder' => 'openblas-linux-x86_64-{{version}}',
                'lib' => 'libopenblas_openmp.so',
                'header' => 'openblas.h'
            ],
            'lapacke.serial' => [
                'folder' => 'openblas-linux-x86_64-{{version}}',
                'lib' => 'liblapacke_serial.so',
                'header' => 'lapacke.h'
            ],
            'lapacke.openmp' => [
                'folder' => 'openblas-linux-x86_64-{{version}}',
                'lib' => 'liblapacke_openmp.so',
                'header' => 'lapacke.h'
            ],
            'onnxruntime' => [
                'folder' => 'onnxruntime-linux-x86_64-{{version}}',
                'lib' => 'libonnxruntime.so',
                'header' => 'onnxruntime.h'
            ],
        ],

        'aarch64-linux' => [
            'archive_format' => 'tar.gz',
            'rindowmatlib.serial' => [
                'folder' => 'rindow-matlib-Linux-{{version}}',
                'lib' => 'librindowmatlib_serial.so',
                'header' => 'matlib.h'
            ],
            'rindowmatlib.openmp' => [
                'folder' => 'rindow-matlib-Linux-{{version}}',
                'lib' => 'librindowmatlib_openmp.so',
                'header' => 'matlib.h'
            ],
            'openblas.serial' => [
                'folder' => 'openblas-linux-arm64-{{version}}',
                'lib' => 'libopenblas_serial.so',
                'header' => 'openblas.h'
            ],
            'openblas.openmp' => [
                'folder' => 'openblas-linux-arm64-{{version}}',
                'lib' => 'libopenblas_openmp.so',
                'header' => 'openblas.h'
            ],
            'lapacke.serial' => [
                'folder' => 'openblas-linux-arm64-{{version}}',
                'lib' => 'liblapacke_serial.so',
                'header' => 'lapacke.h'
            ],
            'lapacke.openmp' => [
                'folder' => 'openblas-linux-arm64-{{version}}',
                'lib' => 'liblapacke_openmp.so',
                'header' => 'lapacke.h'
            ],
            'onnxruntime' => [
                'folder' => 'onnxruntime-linux-arm64-{{version}}',
                'lib' => 'libonnxruntime.so',
                'header' => 'onnxruntime.h'
            ],
        ],

        'x64-windows' => [
            'archive_format' => 'zip',
            'rindowmatlib.serial' => [
                'folder' => 'rindow-matlib-Windows-{{version}}',
                'lib' => 'rindowmatlib_serial.dll',
                'header' => 'matlib.h'
            ],
            'rindowmatlib.openmp' => [
                'folder' => 'rindow-matlib-Windows-{{version}}',
                'lib' => 'rindowmatlib_openmp.dll',
                'header' => 'matlib.h'
            ],
            'openblas.serial' => [
                'folder' => 'openblas-windows-x64-{{version}}',
                'lib' => 'openblas_serial.dll',
                'header' => 'openblas.h'
            ],
            'openblas.openmp' => [
                'folder' => 'openblas-windows-x64-{{version}}',
                'lib' => 'openblas_openmp.dll',
                'header' => 'openblas.h'
            ],
            'lapacke.serial' => [
                'folder' => 'openblas-windows-x64-{{version}}',
                'lib' => 'lapacke_serial.dll',
                'header' => 'lapacke.h'
            ],
            'lapacke.openmp' => [
                'folder' => 'openblas-windows-x64-{{version}}',
                'lib' => 'lapacke_openmp.dll',
                'header' => 'lapacke.h'
            ],
            'onnxruntime' => [
                'folder' => 'onnxruntime-windows-x64-{{version}}',
                'lib' => 'onnxruntime.dll',
                'header' => 'onnxruntime.h'
            ],
        ],
    ];

    public static function downloaderVersion(string $libsDir): string
    {
        $versions = parse_ini_file(self::joinPaths($libsDir, 'VERSIONS'));

        return $versions['DOWNLOADER'];
    }

    public function version(string $libsDir): string
    {
        $versions = parse_ini_file(self::joinPaths($libsDir, 'VERSIONS'));

        return match ($this) {
            self::OpenBlas_Serial,
            self::OpenBlas_OpenMP,
            self::Lapacke_Serial,
            self::Lapacke_OpenMP => $versions['OPENBLAS'],
            self::RindowMatlib_Serial,
            self::RindowMatlib_OpenMP => $versions['RINDOW_MATLIB'],
            self::OnnxRuntime => $versions['ONNXRUNTIME'],
        };
    }

    public static function baseUrl(string $libsDir): string
    {
        return str_replace('{{version}}', self::downloaderVersion($libsDir), self::BASE_URL);
    }

    public static function platformKey(): string
    {
        return match (PHP_OS_FAMILY) {
            'Windows' => 'x64-windows',
            'Darwin' => php_uname('m') == 'x86_64' ? 'x86_64-darwin' : 'arm64-darwin',
            default => php_uname('m') == 'x86_64' ? 'x86_64-linux' : 'aarch64-linux',
        };
    }

    public function exists(string $libsDir): bool
    {
        return file_exists($this->libFile($libsDir)) && file_exists($this->headerFile($libsDir));
    }

    public function libFile(string $libsDir): string
    {
        $file = match ($this) {
            self::OpenBlas_Serial => self::LIBRARIES[self::platformKey()]['openblas.serial']['lib'],
            self::OpenBlas_OpenMP => self::LIBRARIES[self::platformKey()]['openblas.openmp']['lib'],
            self::RindowMatlib_Serial => self::LIBRARIES[self::platformKey()]['rindowmatlib.serial']['lib'],
            self::RindowMatlib_OpenMP => self::LIBRARIES[self::platformKey()]['rindowmatlib.openmp']['lib'],
            self::Lapacke_Serial => self::LIBRARIES[self::platformKey()]['lapacke.serial']['lib'],
            self::Lapacke_OpenMP => self::LIBRARIES[self::platformKey()]['lapacke.openmp']['lib'],
            self::OnnxRuntime => self::LIBRARIES[self::platformKey()]['onnxruntime']['lib'],
        };

        return self::joinPaths($libsDir, $this->folder($libsDir), 'lib', $file);
    }

    public function headerFile(string $libsDir): string
    {
        $file = match ($this) {
            self::OpenBlas_Serial => self::LIBRARIES[self::platformKey()]['openblas.serial']['header'],
            self::OpenBlas_OpenMP => self::LIBRARIES[self::platformKey()]['openblas.openmp']['header'],
            self::RindowMatlib_Serial => self::LIBRARIES[self::platformKey()]['rindowmatlib.serial']['header'],
            self::RindowMatlib_OpenMP => self::LIBRARIES[self::platformKey()]['rindowmatlib.openmp']['header'],
            self::Lapacke_Serial => self::LIBRARIES[self::platformKey()]['lapacke.serial']['header'],
            self::Lapacke_OpenMP => self::LIBRARIES[self::platformKey()]['lapacke.openmp']['header'],
            self::OnnxRuntime => self::LIBRARIES[self::platformKey()]['onnxruntime']['header'],
        };

        return self::joinPaths($libsDir, $this->folder($libsDir), 'include', $file);
    }

    public function folder(string $libsDir): string
    {
        $folder =  match ($this) {
            self::OpenBlas_Serial => self::LIBRARIES[self::platformKey()]['openblas.serial']['folder'],
            self::OpenBlas_OpenMP => self::LIBRARIES[self::platformKey()]['openblas.openmp']['folder'],
            self::RindowMatlib_Serial => self::LIBRARIES[self::platformKey()]['rindowmatlib.serial']['folder'],
            self::RindowMatlib_OpenMP => self::LIBRARIES[self::platformKey()]['rindowmatlib.openmp']['folder'],
            self::Lapacke_Serial => self::LIBRARIES[self::platformKey()]['lapacke.serial']['folder'],
            self::Lapacke_OpenMP => self::LIBRARIES[self::platformKey()]['lapacke.openmp']['folder'],
            self::OnnxRuntime => self::LIBRARIES[self::platformKey()]['onnxruntime']['folder'],
        };

        return str_replace('{{version}}', $this->version($libsDir), $folder);
    }

    public static function ext(): string
    {
        return self::LIBRARIES[self::platformKey()]['archive_format'];
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

<?php

declare(strict_types=1);

namespace Codewithkyrian\TransformersLibrariesDownloader;

enum Libraries
{
    case OpenBlas_Serial;
    case OpenBlas_OpenMP;
    case RindowMatlib_Serial;
    case RindowMatlib_OpenMP;
    case OnnxRuntime;
    case Sndfile;
    case Samplerate;
    case FastTransformersUtils;

    private const BASE_URL = 'https://github.com/CodeWithKyrian/transformers-libsloader/releases/download/{{version}}';
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
            'onnxruntime' => [
                'folder' => 'onnxruntime-osx-x86_64-{{version}}',
                'lib' => 'libonnxruntime.dylib',
                'header' => 'onnxruntime.h'
            ],
            'sndfile' => [
                'folder' => 'libsndfile-darwin-{{version}}',
                'lib' => 'libsndfile.dylib',
                'header' => 'sndfile.h'
            ],
            'samplerate' => [
                'folder' => 'libsamplerate-darwin-{{version}}',
                'lib' => 'libsamplerate.dylib',
                'header' => 'samplerate.h'
            ],
            'fast_transformers_utils' => [
                'folder' => 'fast_transformers_utils-osx-{{version}}',
                'lib' => 'libfast_transformers_utils.dylib',
                'header' => 'fast_transformers_utils.h'
            ]
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
            'onnxruntime' => [
                'folder' => 'onnxruntime-osx-arm64-{{version}}',
                'lib' => 'libonnxruntime.dylib',
                'header' => 'onnxruntime.h'
            ],
            'sndfile' => [
                'folder' => 'libsndfile-darwin-{{version}}',
                'lib' => 'libsndfile.dylib',
                'header' => 'sndfile.h'
            ],
            'samplerate' => [
                'folder' => 'libsamplerate-darwin-{{version}}',
                'lib' => 'libsamplerate.dylib',
                'header' => 'samplerate.h'
            ],
            'fast_transformers_utils' => [
                'folder' => 'fast_transformers_utils-osx-{{version}}',
                'lib' => 'libfast_transformers_utils.dylib',
                'header' => 'fast_transformers_utils.h'
            ]
        ],

        'x86_64-linux' => [
            'archive_format' => 'tar.gz',
            'rindowmatlib.serial' => [
                'folder' => 'rindow-matlib-linux-{{version}}',
                'lib' => 'librindowmatlib_serial.so',
                'header' => 'matlib.h'
            ],
            'rindowmatlib.openmp' => [
                'folder' => 'rindow-matlib-linux-{{version}}',
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
            'onnxruntime' => [
                'folder' => 'onnxruntime-linux-x86_64-{{version}}',
                'lib' => 'libonnxruntime.so',
                'header' => 'onnxruntime.h'
            ],
            'sndfile' => [
                'folder' => 'libsndfile-linux-{{version}}',
                'lib' => 'libsndfile.dylib',
                'header' => 'sndfile.h'
            ],
            'samplerate' => [
                'folder' => 'libsamplerate-linux-{{version}}',
                'lib' => 'libsamplerate.dylib',
                'header' => 'samplerate.h'
            ],
            'fast_transformers_utils' => [
                'folder' => 'fast_transformers_utils-linux-{{version}}',
                'lib' => 'libfast_transformers_utils.dylib',
                'header' => 'fast_transformers_utils.h'
            ]
        ],

        'aarch64-linux' => [
            'archive_format' => 'tar.gz',
            'rindowmatlib.serial' => [
                'folder' => 'rindow-matlib-linux-{{version}}',
                'lib' => 'librindowmatlib_serial.so',
                'header' => 'matlib.h'
            ],
            'rindowmatlib.openmp' => [
                'folder' => 'rindow-matlib-linux-{{version}}',
                'lib' => 'librindowmatlib_openmp.so',
                'header' => 'matlib.h'
            ],
            'openblas.serial' => [
                'folder' => 'openblas-linux-aarch64-{{version}}',
                'lib' => 'libopenblas_serial.so',
                'header' => 'openblas.h'
            ],
            'openblas.openmp' => [
                'folder' => 'openblas-linux-aarch64-{{version}}',
                'lib' => 'libopenblas_openmp.so',
                'header' => 'openblas.h'
            ],
            'onnxruntime' => [
                'folder' => 'onnxruntime-linux-aarch64-{{version}}',
                'lib' => 'libonnxruntime.so',
                'header' => 'onnxruntime.h'
            ],
            'sndfile' => [
                'folder' => 'libsndfile-linux-{{version}}',
                'lib' => 'libsndfile.dylib',
                'header' => 'sndfile.h'
            ],
            'samplerate' => [
                'folder' => 'libsamplerate-linux-{{version}}',
                'lib' => 'libsamplerate.dylib',
                'header' => 'samplerate.h'
            ],
            'fast_transformers_utils' => [
                'folder' => 'fast_transformers_utils-linux-{{version}}',
                'lib' => 'libfast_transformers_utils.dylib',
                'header' => 'fast_transformers_utils.h'
            ]
        ],

        'x64-windows' => [
            'archive_format' => 'zip',
            'rindowmatlib.serial' => [
                'folder' => 'rindow-matlib-windows-{{version}}',
                'bin' => 'rindowmatlib_serial.dll',
                'header' => 'matlib.h'
            ],
            'rindowmatlib.openmp' => [
                'folder' => 'rindow-matlib-windows-{{version}}',
                'bin' => 'rindowmatlib_openmp.dll',
                'header' => 'matlib.h'
            ],
            'openblas.serial' => [
                'folder' => 'openblas-windows-x64-{{version}}',
                'bin' => 'libopenblas_serial.dll',
                'header' => 'openblas.h'
            ],
            'openblas.openmp' => [
                'folder' => 'openblas-windows-x64-{{version}}',
                'bin' => 'libopenblas_openmp.dll',
                'header' => 'openblas.h'
            ],
            'onnxruntime' => [
                'folder' => 'onnxruntime-windows-x64-{{version}}',
                'bin' => 'onnxruntime.dll',
                'header' => 'onnxruntime.h'
            ],
            'sndfile' => [
                'folder' => 'libsndfile-win64-{{version}}',
                'lib' => 'libsndfile.dylib',
                'header' => 'sndfile.h'
            ],
            'samplerate' => [
                'folder' => 'libsamplerate-win64-{{version}}',
                'lib' => 'libsamplerate.dylib',
                'header' => 'samplerate.h'
            ],
            'fast_transformers_utils' => [
                'folder' => 'fast_transformers_utils-windows-{{version}}',
                'lib' => 'libfast_transformers_utils.dylib',
                'header' => 'fast_transformers_utils.h'
            ]
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
            self::OpenBlas_OpenMP, => $versions['OPENBLAS'],
            self::RindowMatlib_Serial,
            self::RindowMatlib_OpenMP => $versions['RINDOW_MATLIB'],
            self::OnnxRuntime => $versions['ONNXRUNTIME'],
            self::Sndfile => $versions['SNDFILE'],
            self::Samplerate => $versions['SAMPLERATE'],
            self::FastTransformersUtils => $versions['FAST_TRANSFORMERS_UTILS']
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
        $subDir = PHP_OS_FAMILY === 'Windows' ? 'bin' : 'lib';

        $file = match ($this) {
            self::OpenBlas_Serial => self::LIBRARIES[self::platformKey()]['openblas.serial'][$subDir],

            self::OpenBlas_OpenMP => self::LIBRARIES[self::platformKey()]['openblas.openmp'][$subDir],

            self::RindowMatlib_Serial => self::LIBRARIES[self::platformKey()]['rindowmatlib.serial'][$subDir],

            self::RindowMatlib_OpenMP => self::LIBRARIES[self::platformKey()]['rindowmatlib.openmp'][$subDir],

            self::OnnxRuntime => self::LIBRARIES[self::platformKey()]['onnxruntime'][$subDir],

            self::Sndfile => self::LIBRARIES[self::platformKey()]['sndfile'][$subDir],

            self::Samplerate => self::LIBRARIES[self::platformKey()]['samplerate'][$subDir],

            self::FastTransformersUtils => self::LIBRARIES[self::platformKey()]['fast_transformers_utils'][$subDir],
        };

        return self::joinPaths($libsDir, $this->folder($libsDir), $subDir, $file);
    }

    public function headerFile(string $libsDir): string
    {
        $file = match ($this) {
            self::OpenBlas_Serial => self::LIBRARIES[self::platformKey()]['openblas.serial']['header'],
            self::OpenBlas_OpenMP => self::LIBRARIES[self::platformKey()]['openblas.openmp']['header'],
            self::RindowMatlib_Serial => self::LIBRARIES[self::platformKey()]['rindowmatlib.serial']['header'],
            self::RindowMatlib_OpenMP => self::LIBRARIES[self::platformKey()]['rindowmatlib.openmp']['header'],
            self::OnnxRuntime => self::LIBRARIES[self::platformKey()]['onnxruntime']['header'],
            self::Sndfile => self::LIBRARIES[self::platformKey()]['sndfile']['header'],
            self::Samplerate => self::LIBRARIES[self::platformKey()]['samplerate']['header'],
            self::FastTransformersUtils => self::LIBRARIES[self::platformKey()]['fast_transformers_utils']['header'],
        };

        return self::joinPaths($libsDir, $this->folder($libsDir), 'include', $file);
    }

    public function folder(string $libsDir): string
    {
        $folder = match ($this) {
            self::OpenBlas_Serial => self::LIBRARIES[self::platformKey()]['openblas.serial']['folder'],
            self::OpenBlas_OpenMP => self::LIBRARIES[self::platformKey()]['openblas.openmp']['folder'],
            self::RindowMatlib_Serial => self::LIBRARIES[self::platformKey()]['rindowmatlib.serial']['folder'],
            self::RindowMatlib_OpenMP => self::LIBRARIES[self::platformKey()]['rindowmatlib.openmp']['folder'],
            self::OnnxRuntime => self::LIBRARIES[self::platformKey()]['onnxruntime']['folder'],
            self::Sndfile => self::LIBRARIES[self::platformKey()]['sndfile']['folder'],
            self::Samplerate => self::LIBRARIES[self::platformKey()]['samplerate']['folder'],
            self::FastTransformersUtils => self::LIBRARIES[self::platformKey()]['fast_transformers_utils']['folder'],
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

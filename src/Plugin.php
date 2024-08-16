<?php

declare(strict_types=1);

namespace Codewithkyrian\TransformersLibsLoader;

use Composer\Composer;
use Composer\Downloader\TransportException;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\Installer\PackageEvents;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Plugin\PluginInterface;
use Composer\Util\HttpDownloader;
use Exception;

class Plugin implements PluginInterface, EventSubscriberInterface
{
    protected Composer $composer;
    protected IOInterface $io;
    protected ?PackageInterface $package;
    protected HttpDownloader $downloader;

    public function activate(Composer $composer, IOInterface $io): void
    {
        $this->composer = $composer;
        $this->io = $io;
        $this->downloader = new HttpDownloader($io, $composer->getConfig());
    }


    public static function getSubscribedEvents(): array
    {
        return [
            PackageEvents::POST_PACKAGE_INSTALL => 'checkSharedLibraries',
            PackageEvents::POST_PACKAGE_UPDATE => 'checkSharedLibraries',
        ];
    }

    public function checkSharedLibraries(PackageEvent $event): void
    {
        $this->package = match ($event->getOperation()->getOperationType()) {
            'install' => $event->getOperation()->getPackage(),
            'update' => $event->getOperation()->getTargetPackage(),
            default => null,
        };

        if ($this->package?->getName() !== 'codewithkyrian/transformers') {
            return;
        }

        try {
            $installationManager = $event->getComposer()->getInstallationManager();
            $installPath = $installationManager->getInstallPath($this->package);
            $libsDir = Library::joinPaths($installPath, 'libs');

            $installationNeeded = false;
            foreach (Library::cases() as $library) {
                if (!$library->exists($libsDir)) {
                    $installationNeeded = true;
                    break;
                }
            }

            if ($installationNeeded) {
                $this->io->write("<info>Installing TransformersPHP libraries...</info>");
                $this->install($installPath);
            }
        } catch (Exception $e) {
            $this->io->writeError($e->getMessage());
            $this->io->writeError("Failed to download shared libraries for TransformersPHP. \nPlease run `./vendor/bin/transformers install` manually to install the libraries.");
        }
    }


    private function install(string $installPath): void
    {
        $version = file_get_contents(Library::joinPaths($installPath, 'VERSION'));

        $os = match (PHP_OS_FAMILY) {
            'Windows' => 'windows',
            'Darwin' => 'macosx',
            default => 'linux',
        };

        $arch = match (PHP_OS_FAMILY) {
            'Windows' => 'x86_64',
            'Darwin' => php_uname('m') == 'x86_64' ? 'x86_64' : 'arm64',
            default => php_uname('m') == 'x86_64' ? 'x86_64' : 'aarch64',
        };

        $extension = match ($os) {
            'windows' => 'zip',
            default => 'tar.gz',
        };

        $maxRetries = 10;
        $attempts = 0;

        do {
            $baseUrl = "https://github.com/CodeWithKyrian/transformers-php/releases/download/$version";
            $downloadFile = "transformersphp-$version-$os-$arch.$extension";
            $downloadUrl = "$baseUrl/$downloadFile";
            $downloadPath = tempnam(sys_get_temp_dir(), 'transformers-php').".$extension";

            $this->io->write("  - Downloading <info>transformersphp-$version-$os-$arch</info>");

            $downloadSuccess = false;

            try {
                $response = $this->downloader->copy($downloadUrl, $downloadPath);
                $downloadSuccess = $response->getStatusCode() === 200;
            } catch (TransportException) {
            }

            if ($downloadSuccess) {
                $this->io->write("  - Installing <info>trasformersphp-$version-$os-$arch</info> : Extracting archive");

                $archive = new \PharData($downloadPath);
                if ($extension != 'zip') {
                    $archive = $archive->decompress();
                }

                $archive->extractTo(Library::joinPaths($installPath, 'libs'), overwrite: true);
                @unlink($downloadPath);

                echo "TransformersPHP libraries installed\n";
                return;
            } else {
                echo "  - Failed to download transformersphp-$version-$os-$arch, trying a lower version...\n";
                $version = self::getLowerVersion($version);
            }

            $attempts++;
        } while ($version !== null && $attempts < $maxRetries);

        throw new \Exception("Could not find the required binaries after $maxRetries attempts.");
    }

    private static function getLowerVersion(string $version): ?string
    {
        $parts = explode('.', $version);

        if (count($parts) === 3 && $parts[2] > 0) {
            $parts[2]--;
        } elseif (count($parts) === 3) {
            $parts[1]--;
            $parts[2] = 9;  // Reset patch version
        } elseif (count($parts) === 2 && $parts[1] > 0) {
            $parts[1]--;
        } else {
            return null;  // No lower version possible
        }

        return implode('.', $parts);
    }

    public function deactivate(Composer $composer, IOInterface $io) {}

    public function uninstall(Composer $composer, IOInterface $io) {}
}
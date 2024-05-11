<?php

declare(strict_types=1);


namespace Codewithkyrian\TransformersLibrariesDownloader;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\Installer\PackageEvents;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Util\HttpDownloader;
use Exception;

class Plugin implements PluginInterface, EventSubscriberInterface
{
    protected Composer $composer;
    protected IOInterface $io;
    protected HttpDownloader $downloader;

    protected string $libsDir;

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
        $package = match ($event->getOperation()->getOperationType()) {
            'install' => $event->getOperation()->getPackage(),
            'update' => $event->getOperation()->getTargetPackage(),
            default => null,
        };

        if ($package?->getName() !== 'codewithkyrian/transformers') {
            return;
        }

        try {
            $installationManager = $event->getComposer()->getInstallationManager();
            $this->libsDir = $installationManager->getInstallPath($package) . '/libs';
            $this->io->write("<info>Checking TransformersPHP libraries...</info>");
            foreach (Libraries::cases() as $library) {
                if (!$library->exists($this->libsDir)) {
                    $name = $library->folder($this->libsDir);

                    $this->downloadAndExtract($name);
                }
            }
        } catch (Exception $e) {
            $this->io->writeError($e->getMessage());
            $this->io->writeError("Failed to download shared libraries for TransformersPHP. Please run `./vendor/bin/transformers-php install` manually to install the libraries.");
        }
    }

    /**
     * @param string $name
     * @return void
     */
    public function downloadAndExtract(string $name): void
    {
        $baseUrl = Libraries::baseUrl($this->libsDir);
        $ext = Libraries::ext();

        $downloadUrl = Libraries::joinPaths($baseUrl, "$name.$ext");
        $downloadPath = tempnam(sys_get_temp_dir(), 'transformers-php') . ".$ext";

        $this->io->write("  - Downloading $name");

        $downloadUrl = "https://github.com/CodeWithKyrian/openblas-builder/releases/download/1.0.0/rindow-matlib-Darwin-1.0.0.tar.gz";

        $this->downloader->copy($downloadUrl, $downloadPath);

        $this->io->write("  - Installing $name : Extracting archive");

        $archive = new \PharData($downloadPath);

        if ($ext != 'zip') {
            $archive = $archive->decompress();
        }

        $archive->extractTo($this->libsDir);
    }


    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }

}
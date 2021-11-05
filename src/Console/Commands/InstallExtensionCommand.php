<?php

namespace Guysolamour\Administrable\Extensions\Shop\Console\Commands;

use Illuminate\Support\Str;
use Guysolamour\Administrable\Console\Extension\BaseExtension;
use Guysolamour\Administrable\Extensions\Shop\ServiceProvider;

class InstallExtensionCommand extends BaseExtension
{


    public function run()
    {
        if ($this->checkifExtensionHasBeenInstalled()) {
            $this->triggerError("The [{$this->name}] extension has already been added, remove all generated files and run this command again!");
        }

        $this->loadViews();
        $this->loadAssets();
        $this->registerSettings();
        $this->loadMigrations(false);
        $this->loadControllers();
        $this->loadRoutes();
        $this->loadSeeders();
        $this->addBuyerTraitToUserModel();
        $this->runMigrateArtisanCommand();

        $this->extension->info("{$this->name} extension added successfully. Don't forget to run composer update for invoice package ");
    }

    public function registerSettings()
    {
        $path = config_path('settings.php');
        $search =  "'settings' => [";
        $this->filesystem->replaceAndWriteFile(
            $this->filesystem->get($path),
            $search,
            <<<TEXT
            $search
                   \Guysolamour\Administrable\Extensions\Shop\Settings\ShopSettings::class,
            TEXT,
            $path
        );

        $this->displayMessage('Settings registered at ' . $path);
    }

    protected function loadViews(): void
    {
        parent::loadViews();

        $this->registerFrontUrlInHeader('cart.show', [], true, 'Panier');
    }

    private function addBuyerTraitToUserModel(): void
    {
        $path = app_path(Str::ucfirst(config('administrable.models_folder'))) . '/User.php';
        $search = "use ModelTrait;";

        $this->filesystem->replaceAndWriteFile(
            $this->filesystem->get($path),
            $search,
            <<<TEXT
            $search
                use BuyerTrait;
            TEXT,
            $path
        );

        $search = "use Guysolamour\Administrable\Traits\ModelTrait;";
        $this->filesystem->replaceAndWriteFile(
            $this->filesystem->get($path),
            $search,
            <<<TEXT
            $search
            use Guysolamour\Administrable\Extensions\Shop\Traits\BuyerTrait;
            TEXT,
            $path
        );
    }

    protected function loadFrontRoutes(): void
    {
        $stubs = $this->getExtensionStubs("/routes/web/front/");

        if (empty($stubs)) {
            return;
        }
        $path   = base_path("routes/web/" . Str::lower($this->getFrontFolder()));

        $this->load($stubs, $path);

        $this->displayMessage('Front routes created at ' . $path);
    }

    protected function loadBackRoutes(): void
    {
        $stubs = $this->getExtensionStubs("/routes/web/back/");

        if (empty($stubs)) {
            return;
        }

        $path   = base_path("routes/web/" . Str::lower($this->getBackFolder()));

        $this->load($stubs, $path);

        $this->displayMessage('Back routes created at ' . $path);
    }


    protected function getExtensionsStubsBasePath(string $path = '')
    {
        return dirname(ServiceProvider::packagePath(), 2) . DIRECTORY_SEPARATOR . $path;
    }
}

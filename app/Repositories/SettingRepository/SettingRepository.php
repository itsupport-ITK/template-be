<?php

namespace App\Repositories\SettingRepository;

use App\Models\Setting;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class SettingRepository extends BaseRepository
{
    /**
     * List of settings based on filter
     */
    public function list(array $params = []): Collection {

        $settingsData = $this->getData($params)->get();

        return $settingsData;
    }

    /**
     * Update settings based on validated input
     */
    public function update(Setting $setting, array $params): Setting
    {

        $setting->update($params);

        return $setting;
    }

    private function getData(array $params = []): Builder
    {

        $settingsData = Setting::filter($params);

        return $settingsData;
    }

    public function getValueByName(string $name): ?string{
        
        return Setting::getByName($name);
    }
}

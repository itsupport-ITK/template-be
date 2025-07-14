<?php

namespace App\Repositories\UserSettingRepository;

use App\Models\Setting;
use App\Models\User;
use App\Models\UserSetting;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserSettingRepository extends BaseRepository
{
    /**
     * List of user settings based on filter
     */
    public function list(User $user, array $params = []): Collection
    {

        $params['user_ids'] = [$user->id];
        $userSettingsData = $this->getData($params)->with(['setting'])->get();

        return $userSettingsData;
    }

    public function listSimplified(User $user, array $params = []): array{
        
        $userSettingData = $this->list($user, $params);
        $plucked = $userSettingData->pluck('value', 'setting.name');
        
        return $plucked->all();
    }

    /**
     * Update user settings based on validated input
     */
    public function update(UserSetting $userSetting, array $params): UserSetting
    {

        $userSetting->update($params);

        return $userSetting;
    }

    private function getData(array $params = []): Builder
    {

        $userSettingData = UserSetting::filter($params);

        return $userSettingData;
    }

    /**
     * Get user settings value by name
     * Ex $name: language
     */
    public function getValueByName(User $user, string $name, string $default): string{
        
        $list = $this->listSimplified($user);

        return $list[$name] ?? $default;
    }

    /**
     * create default setting for user
     */
    public function createDefault(User $user) : UserSetting{

        $settings = UserSetting::firstOrCreate([
            'user_id' => $user->id,
            'setting_id' => Setting::LANGUAGE['id'],
        ], [
            'value' => 'id'
        ]);
        
        return $settings;
    }
}

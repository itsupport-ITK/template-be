<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Setting\UpdateSettingAPIRequest;
use App\Models\Setting;
use App\Repositories\LanguageRepisotory\LanguageRepository;
use App\Repositories\SettingRepository\SettingRepository;
use Illuminate\Http\Request;

class SettingAPIController extends BaseApiController
{
    /**
     * get list of settings with given parameters
     *
     *
     * @return Response
     * @OA\Get(
     *     path="/setting/list",
     *     summary="get list of settings",
     *     tags={"Setting"},
     *     security={{"Bearer":{}}},
     *   @OA\Response(
     *          response="200",
     *          description="setting successfully retrieved"
     *   ),
     *  @OA\Response(
     *     response="400",
     *     description="Invalid input"
     *   )
     * )
     */
    public function list(Request $request, SettingRepository $settingRepository)
    {

        $data = $settingRepository->list();

        return $this->sendSuccess($data, __('messages.settings.list'));
    }


    /**
     * Update settings
     *
     *
     * @return Response
     * @OA\Put(
     *     path="/setting/update/{settings}",
     *     summary="update settings",
     *     tags={"Setting"},
     *     security={{"Bearer":{}}},
     *  @OA\Parameter(
     *     name="settings",
     *     in="path",
     *     required=true,
     *     description="id settings",
     *     @OA\Schema(
     *       type="integer",
     *     )
     *   ),
     *  @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/Setting")
     *   ),
     *     @OA\Response(
     *          response="200",
     *          description="settings successfully updated"
     *   ),
     *  @OA\Response(
     *     response="400",
     *     description="Invalid input"
     *   )
     * )
     */
    public function update(Setting $setting, UpdateSettingAPIRequest $request, SettingRepository $settingRepository)
    {

        $settings = $settingRepository->update($setting, $request->validated());

        return $this->sendSuccess($settings, __('messages.settings.update'));
    }

    /**
     * get list of language settings
     *
     *
     * @return Response
     * @OA\Get(
     *     path="/setting/languages/list",
     *     summary="get list of language settings",
     *     tags={"Setting"},
     *     security={{"Bearer":{}}},
     *   @OA\Response(
     *          response="200",
     *          description="language setting successfully retrieved"
     *   ),
     *  @OA\Response(
     *     response="400",
     *     description="Invalid input"
     *   )
     * )
     */
    public function languages(LanguageRepository $languageRepository){
        
        $languages = $languageRepository->list();

        return $this->sendSuccess($languages, __('messages.settings.list'));
    }
}

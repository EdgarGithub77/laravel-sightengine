<?php

namespace App\Services;

use App\Events\SightengineEvent;
use App\Jobs\SightengineJob;
use App\Models\Sightengine;
use Sightengine\SightengineClient;

class SightengineService
{
    /**
     * @param $data
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function SightengineServiceData($data)
    {
        try {
            SightengineJob::dispatch($data->all());
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return redirect()->back()->with('message', 'File in the process of filtering');
    }

    /**
     * @param $data
     */
    public static function SightengineApiCall($data)
    {
        if (isset($data['link']) && strtoupper(substr($data['link'], -3)) === 'MP4') {
            self::SightengineApiCallVideo($data);
        } else {
            self::SightengineApiCallImage($data);
        }
    }

    /**
     * @param $link
     */
    public static function SightengineApiCallVideo($request)
    {
        $client = new SightengineClient(config('app.sightengine_user'), config('app.sightengine_secret'));
        $output = $client->check([Sightengine::API_MODELS])->video_sync($request['link']);
        $saveFileData = Sightengine::create(['sightengine_data' => $output]);
        event(new SightengineEvent($saveFileData));
    }

    /**
     * @param $data
     */
    public static function SightengineApiCallImage($data)
    {
        $params = array(
            'models' => Sightengine::API_MODELS,
            'api_user' => config('app.sightengine_user'),
            'api_secret' => config('app.sightengine_secret'),
        );

        if (isset($data['file'])) {
            $params['media'] = new \CURLFile($data->file('file'));
            $ch = curl_init(config('app.sightengine_api_url4'));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        } else {
            $params['url'] = $data['link'];
            $ch = curl_init(config('app.sightengine_api_url') . '?' . http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        }

        $response = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($response, true);

        $saveFileData = Sightengine::create(['sightengine_data' => $output]);
        event(new SightengineEvent($saveFileData));
    }
}

<?php

namespace Modules\Zoom\App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

/**
 * trait ZoomMeetingTrait
 */
trait ZoomMeetingTrait
{
    public $client;
    public $token;
    public $headers;

    // Meeting type constants
    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function __construct()
    {
        $this->client = new Client;
        $this->headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function generateZoomToken($user)
    {
        $account_id = $user->zoom_account_id;
        $client_id = $user->zoom_client_id;
        $client_secret = $user->zoom_client_secret;
        
        $client = new Client();

        $requestData = [
            'form_params' => [
                'grant_type' => 'account_credentials',
                'account_id' => $account_id,
            ],
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($client_id . ':' . $client_secret),
            ],
        ];

        $response = $client->post('https://zoom.us/oauth/token', $requestData);
        $responseData = json_decode($response->getBody(), true);

        return $responseData['access_token'];
    }

    private function retrieveZoomUrl()
    {
        return config('zoom.api_url', '');
    }

    private function retrieveAppTimeZone()
    {
        return config('app.timezone', 'UTC');
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);
            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());
            return '';
        }
    }

    public function create_zoom($request, $user)
    {
        $path = 'users/me/meetings';
        $url = $this->retrieveZoomUrl();
        $this->token = $this->generateZoomToken($user);

        $body = [
            'headers' => array_merge($this->headers, [
                'Authorization' => 'Bearer ' . $this->token,
            ]),
            'body' => json_encode([
                'topic' => $request->topic,
                'password' => Str::slug($request->password),
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat($request->start_date),
                'duration' => $request->duration,
                'agenda' => $request->description,
                'timezone' => $this->retrieveAppTimeZone(),
                'settings' => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                ],
            ]),
        ];

        $response = $this->client->post($url . $path, $body);

        return [
            'success' => $response->getStatusCode() === 201,
            'data' => json_decode($response->getBody(), true),
        ];
    }

    public function update_zoom($request, $id, $user)
    {
        $path = 'meetings/' . $id;
        $url = $this->retrieveZoomUrl();
        $this->token = $this->generateZoomToken($user);

        $body = [
            'headers' => array_merge($this->headers, [
                'Authorization' => 'Bearer ' . $this->token,
            ]),
            'body' => json_encode([
                'topic' => $request->topic,
                'password' => Str::slug($request->password),
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat($request->start_date),
                'duration' => $request->duration,
                'agenda' => $request->description,
                'timezone' => $this->retrieveAppTimeZone(),
                'settings' => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                ],
            ]),
        ];

        $response = $this->client->patch($url . $path, $body);

        return [
            'success' => $response->getStatusCode() === 204,
            'data' => json_decode($response->getBody(), true),
        ];
    }

    public function get_zoom($id, $user)
    {
        $path = 'meetings/' . $id;
        $url = $this->retrieveZoomUrl();
        $this->token = $this->generateZoomToken($user);
        
        $body = [
            'headers' => array_merge($this->headers, [
                'Authorization' => 'Bearer ' . $this->token,
            ]),
            'body' => json_encode([]),
        ];

        $response = $this->client->get($url . $path, $body);

        return [
            'success' => $response->getStatusCode() === 200,
            'data' => json_decode($response->getBody(), true),
        ];
    }

    public function delete_zoom($id, $user)
    {
        $path = 'meetings/' . $id;
        $url = $this->retrieveZoomUrl();
        $this->token = $this->generateZoomToken($user);
        
        $body = [
            'headers' => array_merge($this->headers, [
                'Authorization' => 'Bearer ' . $this->token,
            ]),
            'body' => json_encode([]),
        ];

        $response = $this->client->delete($url . $path, $body);

        return [
            'success' => $response->getStatusCode() === 204,
        ];
    }
} 
<?php


namespace AndriiTrush\ServerTime;


use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

/**
 * Class ServerTime
 * @package AndriiTrush\ServerTime
 */
class ServerTime
{

    private const HTTP_URL = 'http://worldtimeapi.org/api/';

    /**
     * @var self
     */
    private static $_instance;
    /**
     * @var Client
     */
    private $http;

    /**
     * ServerTime constructor.
     */
    private function __construct()
    {
        $this->http = new Client(
            [
                'base_uri' => self::HTTP_URL
            ]
        );
    }

    /**
     * @param string|null $ip
     * @return DateTimeInterface
     * @throws GuzzleException
     * @throws Exception
     */
    public static function getDateTime(string $ip = null): DateTimeInterface
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new static();
        }

        $uri = 'ip';

        if (!is_null($ip)) {
            if (ip2long($ip) === false) {
                throw new InvalidArgumentException('Incorrect IP address');
            }
            $uri .= '/' . $ip;
        }
        $response = self::$_instance->http->get($uri)->getBody()->getContents();

        $data = json_decode($response, true);

        if ($data === false) {
            throw new Exception(json_last_error_msg());
        }

        if (!isset($data['datetime'], $data['abbreviation'])) {
            throw new Exception('Incorrect response from server World Time API');
        }

        return new DateTime($data['datetime'], new DateTimeZone($data['abbreviation']));
    }
}

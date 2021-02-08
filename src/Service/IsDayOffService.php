<?php


namespace App\Service;

use DateTimeInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IsDayOffService
{
    private const API_ENTRY_POINT = 'https://isdayoff.ru/api/getdata';
    private const PARAMS_DAYS_FORMAT = 'Ymd';

    private HttpClientInterface $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $params
     * @return \Symfony\Contracts\HttpClient\ResponseInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    private function getRequest($params = []): \Symfony\Contracts\HttpClient\ResponseInterface
    {

        $entryPoint = self::API_ENTRY_POINT;
        if(!empty($params)){
            $entryPoint .= $this->createParamsString($params);        }
        try {
            return $this->client->request('GET', $entryPoint);
        } catch (\Throwable $e){
            echo $e->getMessage();
        }
    }

    /**
     * @param array $params
     * @return string
     */
    private function createParamsString(array $params): string
    {
        $string = '?';
        foreach($params as $key => $value){
            $string .= $key . '=' . $value . '&';
        }
        return $string;
    }

    /**
     * @param DateTimeInterface $date1
     * @param DateTimeInterface $date2
     */
    public function areDaysOff(DateTimeInterface $date1, DateTimeInterface $date2)
    {
        $params = [
            'date1' => $date1->format(self::PARAMS_DAYS_FORMAT),
            'date2' => $date2->format(self::PARAMS_DAYS_FORMAT)
        ];
        return str_split( $this->getRequest($params)->getContent());
    }
}
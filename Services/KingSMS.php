<?php

namespace Sysborg\KingSMS\Services;
use Illuminate\Support\Facades\Http;

class KingSMS 
{
    /**
     * Constroi a classe de envio de sms da KingSMS
     * 
     * @return void
     */
    public function __construct() {
        $this->url = config('kingsms.url');
        $this->login = config('kingsms.login');
        $this->token = config('kingsms.token');
    }

    /**
     * Enviar sms
     * 
     * @param string $para
     * @param string $mensagem
     * @param ?string $campanha = NULL
     * @param ?string $data = NULL,
     * @param ?string $hora = NULL
     * @return array
     */
    public function sendSMS(string $para, string $mensagem, ?string $campanha = NULL, ?string $data = NULL, ?string $hora = NULL): array {
        $data = [
            'acao' => 'sendsms',
            'login' => $this->login,
            'token' => $this->token,
            'numero' => preg_replace('/[^0-9]/', '', $para),
            'msg' => $mensagem,
            'campanha' => $campanha,
            'data' => $data,
            'hora' => $hora
        ];

        $response = Http::get($this->url, $data)->json();
        return $response;
    }

    /**
     * Relatorio do sms enviado
     * 
     * @param string $id
     * @return array
     */
    public function getRelatorio(string $id): array {
        $data = [
            'acao' => 'reportsms',
            'login' => $this->login,
            'id' => $id
        ];

        $response = Http::get($this->url, $data)->json();
        return $response;
    }

    /**
     * Consultar saldo
     * 
     * @return array
     */
    public function getSaldo(): array {
        $data = [
            'acao' => 'saldo',
            'login' => $this->login,
            'token' => $this->token
        ];

        $response = Http::get($this->url, $data)->json();
        return $response;
    }

    /**
     * Consultar resposta do sms
     * 
     * @param string $flag
     * @return array
     */
    public function getResposta(string $flag): array {
        if (!in_array($flag, ['read', 'unread'])) {
            throw new \Exception('Flag inválida');
        }

        $data = [
            'acao' => 'resposta',
            'login' => $this->login,
            'token' => $this->token,
            'flag' => $flag
        ];

        $response = Http::get($this->url, $data)->json();
        return $response;
    }
}
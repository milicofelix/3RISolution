<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 09/10/2015
 * Time: 16:45
 */

namespace tresrisolution\Classes;


class Request
{
    /**
     * Retorna todos os dados das requisições
     *
     * @return  Array, retorna um vetor com os dados da requisição atual
     *
     */
    public function request()
    {
        $data['post'] = $this->post();
        $data['get'] = $this->get();
        $data['parametros'] = $this->params();
        $data['path_info'] = $this->path_info();
        $data['url'] = $this->url();
        $data['base_url'] = $this->base_url();
        return $data;
    }

    public function getParameter($param)
    {
        return $_GET[$param];
    }

}
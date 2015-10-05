<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 05/10/2015
 * Time: 10:20
 */

namespace Classes;


class Autoload
{
    protected $ext;
    protected $prefix;
    protected $sufix;

    /**
     * Define o caminho local at� a raiz do script
     *
     * @param string $path caminho completo at� o script
     *
     * @return  N�o retorna nada
     *
     */
    public function setPath($path)
    {
        set_include_path($path);
    }

    /**
     * Define a extens�o do arquivo a ser exportado
     *
     * @param string $ext a extens�o sem o ponto
     *
     * @return  N�o retorna nada
     *
     */
    public function setExt($ext)
    {
        $this->ext='.'.$ext;
    }

    /**
     * Define se havera algo a se colocar antes do nome do arquivo
     *
     * @param string $prefix o que vai antes do nome do arquivo
     *
     * @return  N�o retorna nada
     *
     */
    public function setPrefix($prefix)
    {
        $this->prefix=$prefix;
    }

    /**
     * Define se havera algo a se colocar ap�s o nome do arquivo
     *
     * @param string $sufix o que vai ap�s o nome do arquivo
     *
     * @return  N�o retorna nada
     *
     */
    public function setSufix($sufix)
    {
        $this->sufix=$sufix;
    }

    /**
     * Transforma a classe em caminho at� o arquivo correspondente
     *
     * @param string $className caminho completo at� o script
     *
     * @return  $fileName: o caminho at� o arquivo da classe
     *
     */
    protected function setFilename($className)
    {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $className = $this->prefix.$className.$this->sufix;
            $fileName  = str_replace('\\', DS, $namespace) . DS;
        }
        $fileName .= str_replace('_', DS, $className) . $this->ext;
        return $fileName;
    }

    /**
     * Carrega arquivos da library
     *
     * @param string $className a classe a se carregar
     *
     * @return  N�o retorna nada
     *
     */
    public function loadCore($className)
    {
        $fileName=$this->setFilename($className);
        $fileName=get_include_path().DS.'Classes'.DS.$fileName;

        if (is_readable($fileName)) {
            include $fileName;
        }
    }

    /**
     * Carrega arquivos da aplica��o
     *
     * @param string $className a classe a se carregar
     *
     * @return  N�o retorna nada
     *
     */
    public function loadApp($className)
    {
        $fileName=$this->setFilename($className);
        $fileName=get_include_path().DS.'Classes'.DS.$fileName;

        if (is_readable($fileName)) {
            include $fileName;
        }

    }

    /**
     * Carrega os m�dulos da aplica��o
     *
     * @param string $className a classe a se carregar
     *
     * @return  N�o retorna nada
     *
     */
    public function loadModules($className)
    {
        $fileName=$this->setFilename($className);
        $fileName=get_include_path().DS.'Classes'.DS.'Modulos'.DS.$fileName;
        //print_r($fileName);exit();
        if (is_readable($fileName)) {
            include $fileName;
        }

    }

    /**
     * Carrega outros arquivos
     *
     * @param string $className a classe a se carregar
     *
     * @return  retorna um erro caso o arquivo n�o seja encontrado
     *
     */
    public function load($className)
    {
        $fileName=$this->setFilename($className);
        $fileName=get_include_path().DS.$fileName;

        if (is_readable($fileName)) {
            include $fileName;
        } else {
            echo $fileName.' n�o encontrado!<br>';
            echo '<pre>';
            var_dump(debug_backtrace());
            echo '</pre>';
            exit;
        }

    }

}
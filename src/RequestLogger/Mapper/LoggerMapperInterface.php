<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 15.07.16
 * Time: 15:23
 */

namespace RequestLogger\Mapper;

use RequestLogger\Document\RequestLog;

interface LoggerMapperInterface
{
    public function find($id);
    public function findAll();
    public function save(RequestLog $log);
    public function query(array $options);
}
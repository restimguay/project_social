<?php

namespace table;

class Member extends BaseTable
{
    public function __construct()
    {
        parent::__construct('member','id');
    }
}
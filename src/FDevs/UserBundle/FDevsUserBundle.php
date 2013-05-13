<?php

namespace FDevs\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FDevsUserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }

}

<?php

$ROUTE['/'] = 'Core/go';
$ROUTE['/add'] = 'Core/add';
$ROUTE['(/\d*)?/edit'] = 'Core/edit$1';
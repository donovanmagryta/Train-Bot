<?php

require 'csv-intersection.php';

echo intersect('data.csv', 'Bar', 'Fizz');
// 2

echo intersect('data.csv', 'Foor', 'Buzz');
// 3

echo intersect('data.csv', 'Foo', 'Bar');
// null
<?php
// Фильтрация числа
function clearInt($data){
    return abs((int)$data);
}

// Фильтрация строки
function clearStr($data){
    return trim(strip_tags($data));
}

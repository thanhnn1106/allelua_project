<?php

/*=========BEGIN USER===================*/
function formatDateUserLogin($createdAt)
{
    $timestamp = strtotime($createdAt);
    return sprintf('Member since %s. %s', date('M', $timestamp), date('Y', $timestamp));
}

function getUserStatus($status)
{
    $statusList = config('allelua.user_status');
    if(isset($statusList[$status])) {
        return $statusList[$status];
    }
    return null;
}
function getUserStatusIcon($status)
{
    $active = config('allelua.user_status_value.active');
    if ((int) $status === $active) {
        return 'label-success';
    }
    return 'label-warning';
}
function isAdmin($role)
{
    if ($role === ROLE_ADMIN) {
        return TRUE;
    }
    return FALSE;
}
/*=========END USER===================*/

/*=========BEGIN CATEGORY - PRODUCT===================*/
function splitTitle($titles, $langs)
{
    $langCodes = explode('|===|', $langs);
    $titles = explode('|===|', $titles);
    $return = array();
    foreach ($langCodes as $index => $code) {
        $return[$code] = isset($titles[$index]) ? $titles[$index] : null;
    }
    return $return;
}

function getCategoryName($titles)
{
    $titles = explode('|===|', $titles);
    return implode('<br/>', $titles);
}

function getProductStatus($status)
{
    $statusList = config('product.product_status');
    if(isset($statusList[$status])) {
        return $statusList[$status];
    }
    return null;
}
function getProductStatusIcon($status)
{
    $active = config('product.product_status_value.active');
    if ((int) $status === $active) {
        return 'label-success';
    }
    return 'label-warning';
}
/*=========END CATEGORY - PRODUCT===================*/
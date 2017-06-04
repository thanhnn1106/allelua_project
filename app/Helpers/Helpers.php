<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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


function getAvatarImage($value)
{
    $avatarPath = \Config::get('custom.free_path_upload_avatar').'/';
    if(!empty($value) && file_exists( public_path().$avatarPath.$value)) {
        return $avatarPath.$value;
    } else {
        return $avatarPath.'default.png';
    }
}

function getHomeImage($value)
{
    if (empty($value)) {
        return '';
    }
    $homePath = \config('experteyes.path_upload_home');
    if(file_exists( public_path().$homePath.$value)) {
        return $homePath.$value;
    }
    return '';
}

function getStatusOffer($value)
{
    $statusOfferLists = trans('define.offer_status_lists');
    if (isset($statusOfferLists[$value])) {
        return $statusOfferLists[$value];
    }
    return '';
}
function getStatusApplication($value)
{
    $statusLists = trans('define.application_status_lists');
    if (isset($statusLists[$value])) {
        return $statusLists[$value];
    }
    return '';
}

function formatDateVN($date)
{
    if (empty($date)) {
        return '';
    }
    if ($date === '0000-00-00' || $date === '0000-00-00 00:00:00') {
        return '';
    }
    return date('d/m/Y', strtotime($date));
}

function getDateNotZero($date)
{
    if (empty($date)) {
        return '';
    }
    if ($date === '0000-00-00' || $date === '0000-00-00 00:00:00') {
        return '';
    }
    return date('Y-m-d', strtotime($date));
}

function convertDateToYMD($date)
{
    if (empty($date)) {
        return '';
    }
    $part = explode('/', $date);
    return @$part[2] . '-' . @$part[1] . '-' . @$part[0];
}

/**
 * convert DateTime To Date
 * 
 * @param String $date
 * @return String
 */
function convertDateTimeToDate($date) {
    $tempDate = \DateTime::createFromFormat('Y-m-d H:i:s', $date);
    if ($tempDate) {
        return $tempDate->format('d/m/Y');
    }
}

function convertDateToDate($date) {
    $tempDate = \DateTime::createFromFormat('d/m/Y', $date);
    if ($tempDate) {
        return $tempDate->format('Y-m-d');
    }
}

function translateArray($arr, $with_all) {
    if (!$with_all) {
        array_shift($arr);
    }
    $new_arr = array();
    foreach ($arr as $k => $v) {
        if (!$with_all) $k++; //array shift re-order key of array
        $new_arr[$k] = trans($v);
    }
    return $new_arr;
}

function transDataArray(&$array) {
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $array[$key] = trans($value);
        }
    }
    
    return $array;
}


/**
 * check user role admin
 * @param User $user
 * @return boolean
 */
function checkRoleAdmin($user) {
    $roleAdmin = config('experteyes.roles_admin');
    if (isset($roleAdmin[$user->role_id])) {
        return true;
    }
    return false;
}

function getStatusInvoice($status)
{
    $invoices = \config('experteyes.invoice_status');
    if (isset($invoices[$status])) {
        return trans($invoices[$status]);
    }
    return '';
}

function printSecondToHourMin($second) {
    $result = "";
    $hour = floor($second/3600);
    if ($hour >0) {
        $result .= $hour." ".trans('common.hour');
    }
    $minute =  floor(($second - $hour*3600)/60);
    if ($minute >0 ) {
        $result .= " ".$minute." ".trans('common.minute');
    }
    
    return $result;
}

function unserializeData($strSerial)
{
    if (empty($strSerial)) {
        return array();
    }
    return unserialize($strSerial);
}

function linkEditProfile() {
    $user = Auth::user();
    switch ($user->role_id) {
        case ROLE_SUPER_ADMIN:
        case ROLE_ADMIN:
            return '/admin/change-password';
        case ROLE_FREELANCER:
            return '/freelancer/profile';
        case ROLE_CUSTOMER:
            return '/customer/profile';
    }
}

function linkUserDefault() {
    $user = Auth::user();
    switch ($user->role_id) {
        case ROLE_SUPER_ADMIN:
        case ROLE_ADMIN:
            return '/admin';
        case ROLE_FREELANCER:
            return '/freelancer/myoffer';
        case ROLE_CUSTOMER:
            return '/customer/offer';
    }
}
    








function upperLastName($value)
{
    if (!empty($value)) {
        return strtoupper($value);
    }
    return $value;
}

function activeTabWhenError($errors)
{
    if (!count($errors->all())) {
        return 'tab1';
    }
    $listKeys = $errors->keys();
    if (empty($listKeys) || !count($listKeys)) {
        return 'tab1';
    }
    $tabs = array(
        'tab2' => array('position', 'introduce', 'daily_rate', 'transport_duration', 'transport_mode', 'type_available', 'date_maintenance', 'years_experience'),
        'tab4' => array('society_name', 'number_secret')
    );

    $tabName = 'tab1';
    foreach ($tabs as $keyTab => $tab) {
        foreach ($tab as $value) {
            if(in_array($value, $listKeys)) {
                $tabName = $keyTab;
                break;
            }
        }
    }
    return $tabName;
}

/**
 * Check Address is changed
 * @param Address $address
 * @param Request $request
 * @return boolean
 */
function checkAddressIsChanged($address, $request) {
    $check1 = strtolower($address->address) == strtolower($request->input("address"));
    $check2 = strtolower($address->city) == strtolower($request->input("ville"));
    $check3 = strtolower($address->postal_code) == strtolower($request->input("postal_code"));
    if ($request->input("department") == "") {
        $check4 = true;
    } else {
        $check4 = strtolower($address->department) == strtolower($request->input("department"));
    }
   
    if ($check1 && $check2 && $check3 && $check4) {
        return false;
    }
    
    return true;
}

/**
 * Check Address is changed
 * @param Address $address
 * @param Request $request
 * @return boolean
 */
function checkAddressIsChanged1($address, $addressTemp) {
    $check1 = $address->address == $addressTemp->address;
    $check2 = $address->city == $addressTemp->city;
    $check3 = $address->postal_code == $addressTemp->postal_code;
    $check4 = $address->department == $addressTemp->department;
   
    if ($check1 && $check2 && $check3 && $check4) {
        return false;
    }
    
    return true;
}

/**
 * Check field on user is modify
 * @param Object|integer $user
 * @param String $field
 * @return boolean
 */
function UserModifyField($user, $field) {
  
    if (is_object($user)) {
        try {
            $userTemp = App\Models\UserTemp::getLastRevision($user);
            if ($userTemp) {
                
                if ($user->$field != $userTemp->$field) {
                    return true;
                }
            }
        } catch (\Exception $exception) {
            return false;
        }
    }
    
    return false;
}

/**
 * 
 * @param type $user
 * @param type $field
 * @return string
 */
function UserModifyFieldClass($user, $field) {
    $currentUser = Auth::user();
    if (!checkRoleAdmin($currentUser)) {
        return false;
    }
    
    if (UserModifyField($user, $field)) {
        return " hight-light-modify ";
    }
}

/**
 * Check Address field is modify
 * @param type $address
 * @param type $field
 * @return boolean
 */
function AddressModifyField($address, $field) {
 
    if (is_object($address)) {
        try {
            $addressTemp = App\Models\AddressTemp::getLastRevision($address);
        
            if ($addressTemp) {
                if ($address->$field != $addressTemp->$field) {
                    return true;
                }
            }
        } catch (Exception $ex) {
            return false;
        }
    }
    
    return false;
}

/**
 * 
 * @param type $address
 * @param type $field
 * @return boolean|string
 */
function AdressModifyFieldClass($address, $field) {
    $user = Auth::user();
    if (!checkRoleAdmin($user)) {
        return false;
    }
    
    if (AddressModifyField($address, $field)) {
        return " hight-light-modify ";
    }
}

/**
 * Check freelancer profile field is changed.
 * @param type $profile
 * @param type $field
 * @return boolean
 */
function fProfileModifyField($profile, $field) {
    if (is_object($profile)) {
        try {
            $profileTemp = App\Models\FreelancerProfilesTemp::getLastRevision($profile);
        
            if ($profileTemp) {
                if ($profile->$field != $profileTemp->$field) {
                    return true;
                }
            }
        } catch (Exception $ex) {
            return false;
        }
    }
    
    return false;
}

/**
 * return class heightlight if field of freelancer profile is changed
 * @param type $user
 * @param type $field
 * @return boolean|string
 */
function fProfileModifyFieldClass($user, $field) {
    $currentUser = Auth::user();
    if (!checkRoleAdmin($currentUser)) {
        return false;
    }
   
    if (fProfileModifyField($user->freelancerProfile, $field)) {
        return " hight-light-modify ";
    }
}

/**
 * 
 * @param type $offer
 * @param type $field
 * @return boolean
 */
function offerModifyField($offer, $field) {
    if (is_object($offer)) {
        try {
            $offerTemp = App\Models\OfferTemp::getLastRevision($offer);
            if ($offerTemp) {
                if (trim($offer->getAttribute($field)) != trim($offerTemp->getAttribute($field))) {
                    return true;
                }
            }
        } catch (\Exception $exception) {
            return false;
        }
    }
    
    return false;
}

function offerModifyFieldClass($offer, $field) {
    $currentUser = Auth::user();
    if (!checkRoleAdmin($currentUser)) {
        return false;
    }
   
    if (offerModifyField($offer, $field)) {
        return " hight-light-modify ";
    }
}

/**
 * Check skill in one offer is modified or not
 * @param Integer $offerId
 * @return boolean
 */
function offerModifySkill($offerId) {
    $count = App\Models\OfferSkill::where('os_offer_id', $offerId)->where('status', '!=', REFER_STATUS_APPROVE)->count();
    if ($count>0) {
        return true;
    } else {
        return false;
    }
}

function offerModifySkillClass($offer) {
    if (offerModifySkill($offer->id) && $offer->request) {
        return " hight-light-block-modify ";
    }
}

/**
 * Check techincal in one offer is modified or not
 * @param type $offerId
 * @return boolean
 */
function offerModifyTechnical($offerId) {
    $count = App\Models\OfferTechnicalArea::where('offer_id', $offerId)->where('status', '!=', REFER_STATUS_APPROVE)->count();
    if ($count>0) {
        return true;
    } else {
        return false;
    }
}

function offerModifyTechnicalClass($offer) {
    if (offerModifyTechnical($offer->id) && $offer->request) {
        return " hight-light-block-modify ";
    }
}

/**
 * Check skill in freelancer is modified or not
 * @param type $freelancerId
 * @return boolean
 */
function freelancerModifySkill($freelancerId) {
    $count = App\Models\FreelancerSkill::where('user_id', $freelancerId)->where('status', '!=', REFER_STATUS_APPROVE)->count();
    if ($count>0) {
        return true;
    } else {
        return false;
    }
}

function freelancerModifySkillClass($freelancer) {
    $currentUser = Auth::user();
    if (!checkRoleAdmin($currentUser)) {
        return false;
    }
    
    if (freelancerModifySkill($freelancer->id) && $freelancer->request) {
        return " hight-light-block-modify ";
    }
}


/**
 * Check Technical in freelancer is modified or not
 * @param type $offer
 * @return boolean
 */

function freelancerModifyTechnical($freelancerId) {
    $count = App\Models\FreelancerTeachnicalArea::where('user_id', $freelancerId)->where('status', '!=', REFER_STATUS_APPROVE)->count();
    if ($count>0) {
        return true;
    } else {
        return false;
    }
}

function freelancerModifyTechnicalClass($freelancer) {
    $currentUser = Auth::user();
    if (!checkRoleAdmin($currentUser)) {
        return false;
    }
    
    if (freelancerModifyTechnical($freelancer->id) && $freelancer->request) {
        return " hight-light-block-modify ";
    }
}

/**
 * Check Language in freelancer is modified or not
 * @param type $freelancerId
 * @return boolean
 */

function freelancerModifyLanguage($freelancerId) {
    $count = App\Models\FreelancerLanguage::where('user_id', $freelancerId)->where('status', '!=', REFER_STATUS_APPROVE)->count();
    if ($count>0) {
        return true;
    } else {
        return false;
    }
}

function freelancerModifyLanguageClass($freelancer) {
    $currentUser = Auth::user();
    if (!checkRoleAdmin($currentUser)) {
        return false;
    }
    
    if (freelancerModifyLanguage($freelancer->id) && $freelancer->request) {
        return " hight-light-block-modify ";
    }
}








// check radio on form offer check or not
function isDateStartOfferAsap($offer) {
    if (Request::input('start_date')) {
        if (Request::input('start_date') == 'asap') {
            return true;
        }
        return false;
    }
    
    if ($offer->id && strcmp($offer->start_date, $offer->created_at) == 0) {
        return true;
    }
    return false;
    
}

/**
 * cut number word 
 * @param type $string
 * @param type $number
 * @return string 
 */
function cutNumberWord($string, $number = 20) {
    $string = trim($string);
    $string = strip_tags($string);
    $listWord = explode(" ", $string); 
    $result = "";
    foreach ($listWord as $key => $value) {
        if ($key > $number) break;
        $result .= $value." ";
    }
    if (count($listWord) > $number) {
        $result .= "...";
    }
    
    return $result;
}

/**
 * Convert format Y-m to m-Y
 * @param String $string
 * @return string
 */
function convertYmtomY($string) {
    $date = \DateTime::createFromFormat('Y-m', $string);
    if ($date) {
        return $date->format('m/Y');
    }
    return "";
}